#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <WebServer.h> // Biblioteca para servidor HTTP

#define RST_PIN 22 // Pino RST do RFID
#define SS_PIN 21  // Pino SDA (SS) do RFID
#define RELAY_PIN 16 // Pino GPIO para o relé
#define LED_PIN 17 // Pino GPIO para o LED

MFRC522 mfrc522(SS_PIN, RST_PIN); // Cria uma instância MFRC522
const char* ssid = "Missiroli";
const char* password = "5607bianca";
WebServer server(80); // Inicializa o servidor na porta 80

void setup() {
  Serial.begin(115200); // Inicia a comunicação serial
  SPI.begin(); // Inicia a interface SPI
  mfrc522.PCD_Init(); // Inicia o leitor RFID
  pinMode(RELAY_PIN, OUTPUT); // Define o pino do relé como saída
  pinMode(LED_PIN, OUTPUT); // Define o pino do LED como saída
  digitalWrite(RELAY_PIN, HIGH); // Inicia o relé desligado

  // Conectar ao Wi-Fi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");

  // Configura a rota para destravar
  server.on("/destravar", handleDestravar);
  server.begin(); // Inicia o servidor
  Serial.println("Server started");
}

void loop() {
  server.handleClient(); // Lida com clientes HTTP

  // Verifica se há um novo cartão presente
  if (!mfrc522.PICC_IsNewCardPresent()) {
    return;
  }

  // Verifica se a leitura do cartão foi feita corretamente
  if (!mfrc522.PICC_ReadCardSerial()) {
    return;
  }

  // Obtém o UID do cartão
  String content = "";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  content.toUpperCase();

  // Verifica se o UID lido corresponde ao UID autorizado
  if (content.substring(1) == "B3 C0 5F 27") { // Substitua pelo UID do seu cartão
    Serial.println("Cartão autorizado!");
    destravarFechadura();
  } else {
    Serial.println("Cartão não autorizado!");
    // Faz o LED piscar indicando que o cartão não é autorizado
    for (int i = 0; i < 5; i++) {
      digitalWrite(LED_PIN, HIGH);
      delay(500);
      digitalWrite(LED_PIN, LOW);
      delay(500);
    }
  }
}

void handleDestravar() {
  Serial.println("Destravar solicitação recebida");
  destravarFechadura();
  server.send(200, "text/plain", "ok"); // Responde ao cliente
}

void destravarFechadura() {
  digitalWrite(RELAY_PIN, LOW); // Aciona o relé
  enviarDados(1); // Envia estado da fechadura: aberta
  delay(5000); // Mantém o relé ligado por 5 segundos
  digitalWrite(RELAY_PIN, HIGH); // Desliga o relé
  enviarDados(0); // Envia estado da fechadura: fechada

  // Reiniciar o ESP32
  Serial.println("Reiniciando o ESP32...");
  delay(1000); // Aguardar um segundo antes de reiniciar
  ESP.restart();
}

void enviarDados(int estado) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin("https://tccfechadura.000webhostapp.com/controller/relacao.controller.php"); // Substitua pelo endereço do seu servidor PHP
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    String postData = "acao=salvar_dados&CodUser=3&CodFechadura=2&estado=" + String(estado);
    
    Serial.print("Enviando dados: ");
    Serial.println(postData);

    int httpResponseCode = http.POST(postData);
    
    if (httpResponseCode > 0) {
      String response = http.getString();  // Obtém a resposta do servidor
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
      Serial.print("Response from server: ");
      Serial.println(response);
    } else {
      Serial.print("Error on sending request: ");
      Serial.println(httpResponseCode);  // Imprime o código de resposta HTTP
    }
    http.end();
  } else {
    Serial.println("WiFi Disconnected");
  }
}
