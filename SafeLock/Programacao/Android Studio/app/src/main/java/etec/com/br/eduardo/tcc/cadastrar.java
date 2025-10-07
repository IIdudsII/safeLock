package etec.com.br.eduardo.tcc;

import androidx.appcompat.app.AppCompatActivity;

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

public class cadastrar extends AppCompatActivity {

    EditText edCadUser, edCpf, edCadSenha;
    Button btCadastrar, btVoltar;

    CadUsuario cad = new CadUsuario();


    public static String caminho = "http://" + MainActivity.ip + "/php/controller/usuario.controller.php?acao=";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cadastrar);

        btVoltar = findViewById(R.id.btnVoltar3);
        edCadUser = findViewById(R.id.edtCadUser);
        edCadSenha = findViewById(R.id.edtCadSenha);
        edCpf = findViewById(R.id.edtCpf);
        btCadastrar = findViewById(R.id.btnCadCadastrar);





        //bt voltar
        btVoltar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent VoltaLog = new Intent(cadastrar.this, MainActivity.class);
                finish();
                startActivity(VoltaLog);
            }
        });


        //bt cad
        btCadastrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if(edCadUser.getText().toString().isEmpty()){
                    edCadUser.setError("Usuario Obirgatório");
                    edCadUser.requestFocus();
                }
                else if(edCpf.getText().toString().isEmpty()){
                    edCpf.setError("CPF Obrigatório");
                    edCpf.requestFocus();
                }
                else if(edCadSenha.getText().toString().isEmpty()){
                    edCadSenha.setError("Senha Obrigatória");
                    edCadSenha.requestFocus();
                }
                else {

                    // fazendo a verificação se o cpf exite se sim cadastra se não da erro
                    cad.setUser(edCadUser.getText().toString());
                    cad.setCpf(edCpf.getText().toString());
                    cad.setSenha(edCadSenha.getText().toString());

                    verificar(caminho + "vCpf");


                    limparDados();

                }
            }
        });

    }

    private void limparDados() {
        edCadUser.setText(null);
        edCadSenha.setText(null);
        edCpf.setText(null);
    }

    public void cadastrar(String endereco){
        StringRequest stringRequest = new
                StringRequest(Request.Method.POST, endereco,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                if (response.equalsIgnoreCase("ok")) {
                                    Log.e("Teste",response);
                                    Toast.makeText(cadastrar.this, "Dados Cadastrados com Sucesso!", Toast.LENGTH_SHORT).show();

                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(cadastrar.this, "Não foi possível Cadastrar " + error, Toast.LENGTH_SHORT).show();
                            }
                        }
                ){
                    protected Map<String,String> getParams() throws
                            AuthFailureError {
                        Map<String,String> params = new HashMap<>();
                        params.put("nom",cad.getUser());
                        params.put("cpf",cad.getCpf());
                        params.put("sen",cad.getSenha());
                        return params;
                    }
                };
        RequestQueue requestQueue = Volley.newRequestQueue(cadastrar.this);
        requestQueue.add(stringRequest);
        requestQueue.getCache().clear();


    }

    public void verificar (String vcpf){
        StringRequest stringRequest = new
                StringRequest(Request.Method.POST, vcpf,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                if (response.equalsIgnoreCase("CPF Existente")) {
                                    Toast.makeText(cadastrar.this, "Não Foi possivel cadastrar, cpf ja cadastrado", Toast.LENGTH_SHORT).show();
                                }
                                else{
                                    cadastrar(caminho + "cadastrar");
                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(cadastrar.this, "Não foi possível Cadastrar " + error, Toast.LENGTH_SHORT).show();
                            }
                        }
                ){
                    protected Map<String,String> getParams() throws
                            AuthFailureError {
                        Map<String,String> params = new HashMap<>();
                        params.put("cpf",cad.getCpf());
                        return params;
                    }
                };
        RequestQueue requestQueue = Volley.newRequestQueue(cadastrar.this);
        requestQueue.add(stringRequest);
        requestQueue.getCache().clear();


    }


}