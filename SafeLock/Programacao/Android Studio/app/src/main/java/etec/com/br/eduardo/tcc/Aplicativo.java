package etec.com.br.eduardo.tcc;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class Aplicativo extends AppCompatActivity {

    ImageView imvCadeado;

    TextView nome, fechadura;
    int estado = 0;

    CadRelacao cad = new CadRelacao();

    public static String caminho = "http://" + MainActivity.ip + "/php/controller/relacao.controller.php?acao=";


    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_aplicativo);

        imvCadeado = findViewById(R.id.imvCadeado);
        nome = findViewById(R.id.txtNome);
        fechadura = findViewById(R.id.txtFechadura);

        nome.setText(MainActivity.usuario);
        fechadura.setText(devices.nome);


        ultEstado(caminho + "retorna_ultimo_estado");
















    }

    public void clicarDevices(View view)
    {
        Intent abrirTelaDevices = new Intent(Aplicativo.this, devices.class);
        finish();
        startActivity(abrirTelaDevices);
    }

    public void clicarHome(View view)
    {
        Intent abrirTelaApp = new Intent(Aplicativo.this, Aplicativo.class);
        finish();
        startActivity(abrirTelaApp);

    }

    public void clicarNotif(View view)
    {
        Intent abrirTelaNotif = new Intent(Aplicativo.this, notificacoes.class);
        finish();
        startActivity(abrirTelaNotif);

    }




    public void clicarImagem(View view)
    {
        if(estado == 0)
        {
            //trocar a imagem para aberto
            imvCadeado.setImageResource(R.drawable.lock_open);
            estado = 1;
        }
        else
        {
            //trocar a imagem para fechado
            imvCadeado.setImageResource(R.drawable.lock_closed);
            estado = 0;
        }

        cadastrar(caminho + "cadastrar");


    }

    public void cadastrar(String endereco){
        StringRequest stringRequest = new
                StringRequest(Request.Method.POST, endereco,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                if (response.equalsIgnoreCase("ok")) {
                                    Log.e("Teste",response);
                                    Toast.makeText(Aplicativo.this, "Dados Cadastrados com Sucesso!", Toast.LENGTH_SHORT).show();

                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(Aplicativo.this, "Selecione a Fechadura na aba de dispositivos", Toast.LENGTH_SHORT).show();
                            }
                        }
                ){
                    protected Map<String,String> getParams() throws
                            AuthFailureError {
                        Map<String,String> params = new HashMap<>();
                        params.put("cdUser",MainActivity.codUser);
                        params.put("cdFecha",devices.idF);
                        params.put("slEstado", String.valueOf(estado));
                        return params;
                    }
                };
        RequestQueue requestQueue = Volley.newRequestQueue(Aplicativo.this);
        requestQueue.add(stringRequest);
        requestQueue.getCache().clear();


    }



    public void ultEstado(String endereco) {
        StringRequest stringRequest = new StringRequest(Request.Method.POST, endereco,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Log.e("Retorno:", response);
                        if (response.trim().equals("Fechado")) { // Se o estado for 0 (fechado)
                            Toast.makeText(Aplicativo.this, "A Fechadura está Fechada", Toast.LENGTH_SHORT).show();
                            imvCadeado.setImageResource(R.drawable.lock_closed);
                        } else if (response.trim().equals("Aberta")) { // Se o estado for 1 (aberto)
                            Toast.makeText(Aplicativo.this, "A Fechadura está Aberta", Toast.LENGTH_SHORT).show();
                            imvCadeado.setImageResource(R.drawable.lock_open);
                        } else {
                            // Se a resposta não for reconhecida como um estado válido, trate de acordo com sua lógica

                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                    }
                }
        ){
            protected Map<String,String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<>();
                params.put("cdFecha",devices.idF);
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(Aplicativo.this);
        requestQueue.add(stringRequest);
        requestQueue.getCache().clear();
    }





    public void destravar() {
        String endereco = caminho + "destravar";
        StringRequest stringRequest = new StringRequest(Request.Method.POST, endereco,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        if (response.equalsIgnoreCase("ok")) {
                            Log.e("Teste", response);
                            Toast.makeText(Aplicativo.this, "Fechadura destravada com sucesso!", Toast.LENGTH_SHORT).show();
                        } else {
                            Toast.makeText(Aplicativo.this, "Erro ao destravar fechadura!", Toast.LENGTH_SHORT).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(Aplicativo.this, "Erro na solicitação de destravamento", Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() {
                return new HashMap<>(); // Retorna um mapa vazio, pois não queremos enviar nenhum dado
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(Aplicativo.this);
        requestQueue.add(stringRequest);
    }







}


