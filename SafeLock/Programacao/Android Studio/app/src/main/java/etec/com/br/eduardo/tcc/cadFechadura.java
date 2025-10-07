package etec.com.br.eduardo.tcc;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
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

public class cadFechadura extends AppCompatActivity {

    EditText edNome, edPin;

    Button btCad,btVoltar3;



    CadFecha cad = new CadFecha();

    public static String caminho = "http://" + MainActivity.ip + "/php/controller/fechadura.controller.php?acao=";

    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cad_fechadura);

        edNome  = findViewById(R.id.edtNomeFechadura);
        edPin = findViewById(R.id.edtPin);
        btCad = findViewById(R.id.btnCadFechadura);
        btVoltar3 = findViewById(R.id.btnVoltar3);


btVoltar3.setOnClickListener(new View.OnClickListener() {
    @Override
    public void onClick(View view) {

        Intent VoltaDevices = new Intent(cadFechadura.this, devices.class);
        finish();
        startActivity(VoltaDevices);
    }
});
        btCad.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if(edNome.getText().toString().isEmpty()){
                    edNome.setError("Nome Obrigatório");
                    edNome.requestFocus();
                }
                else if(edPin.getText().toString().isEmpty()){
                    edPin.setError("PIN Obrigatório");
                    edPin.requestFocus();
                }
                else {

                    // fazendo a verificação se o pin existe se sim cadastra se não da erro
                    cad.setNome(edNome.getText().toString());
                    cad.setPin(edPin.getText().toString());

                    verificarPin(caminho + "vPin");


                    limparDados();

                }
            }
        });







    }

    private void limparDados() {
        edNome.setText(null);
        edPin.setText(null);
    }

    public void cadastrarFecha(String endereco){
        StringRequest stringRequest = new
                StringRequest(Request.Method.POST, endereco,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                if (response.equalsIgnoreCase("ok")) {
                                    Log.e("Teste",response);
                                    Toast.makeText(cadFechadura.this, "Dados Cadastrados com Sucesso!", Toast.LENGTH_SHORT).show();

                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(cadFechadura.this, "Não foi possível Cadastrar " + error, Toast.LENGTH_SHORT).show();
                            }
                        }
                ){
                    protected Map<String,String> getParams() throws
                            AuthFailureError {
                        Map<String,String> params = new HashMap<>();
                        params.put("nom",cad.getNome());
                        params.put("pin",cad.getPin());
                        params.put("cdUser", MainActivity.codUser);
                        return params;
                    }
                };
        RequestQueue requestQueue = Volley.newRequestQueue(cadFechadura.this);
        requestQueue.add(stringRequest);
        requestQueue.getCache().clear();


    }


    public void verificarPin (String vpin){
        StringRequest stringRequest = new
                StringRequest(Request.Method.POST, vpin,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                if (response.startsWith("PIN E")) {
                                    Toast.makeText(cadFechadura.this, "Não Foi possivel cadastrar, pin ja cadastrado", Toast.LENGTH_SHORT).show();
                                }
                                else{
                                    cadastrarFecha(caminho + "cadastrar");
                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(cadFechadura.this, "Não foi possível Cadastrar" + error, Toast.LENGTH_SHORT).show();
                            }
                        }
                ){
                    protected Map<String,String> getParams() throws
                            AuthFailureError {
                        Map<String,String> params = new HashMap<>();
                        params.put("pin",cad.getPin());
                        return params;
                    }
                };
        RequestQueue requestQueue = Volley.newRequestQueue(cadFechadura.this);
        requestQueue.add(stringRequest);
        requestQueue.getCache().clear();


    }




}