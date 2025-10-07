package etec.com.br.eduardo.tcc;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
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

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class MainActivity extends AppCompatActivity {

    EditText edUser, edSenha;

    Button btLogar, btCad;

    CadUsuario cad = new CadUsuario();
    private List<CadUsuario> listaCadUsuario = new
            ArrayList<>();
    private ArrayAdapter<CadUsuario> adaptadorCadUser;

    public static String usuario, senha, codUser;


    public static String ip = "192.168.1.22";
    public static String caminho = "http://"+ ip +"/php/controller/usuario.controller.php?acao=";
    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        edUser = findViewById(R.id.edtUser);
        edSenha = findViewById(R.id.edtSenha);
        btLogar = findViewById(R.id.btnCadFechadura);
        btCad = findViewById(R.id.btnCad);




        //BOTAO LOGAR
        btLogar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                usuario = edUser.getText().toString();
                senha = edSenha.getText().toString();



                if (edUser.getText().toString().isEmpty()) {
                    edUser.setError("Usuario Obirgatório");
                    edUser.requestFocus();
                } else if (edSenha.getText().toString().isEmpty()) {
                    edSenha.setError("Senha Obrigatória");
                    edSenha.requestFocus();
                } else {
                    cad.setUser(edUser.getText().toString());
                    cad.setSenha(edSenha.getText().toString());

                    logar(caminho + "login");
                    limparDados();
                }

            }
        });


        //BOTAO CADASTRAR
        btCad.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Intent abrirTelaCad = new Intent(MainActivity.this, cadastrar.class);
                finish();
                startActivity(abrirTelaCad);

            }
        });





    }

    private void limparDados() {
        edUser.setText(null);
        edSenha.setText(null);
    }


    public void logar (String login){
        StringRequest stringRequest = new
                StringRequest(Request.Method.POST, login,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                Log.e("Retorno:",response);
                                if (response.startsWith("false")) {
                                    Toast.makeText(MainActivity.this, "Não foi possível Logar ", Toast.LENGTH_SHORT).show();
                                }
                                else{
                                    codUser = response;
                                    Intent abrirApp = new Intent(MainActivity.this, Aplicativo.class);
                                    startActivity(abrirApp);

                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(MainActivity.this, "Não foi possível Logar " + error, Toast.LENGTH_SHORT).show();
                            }
                        }
                ){
                    protected Map<String,String> getParams() throws
                            AuthFailureError {
                        Map<String,String> params = new HashMap<>();
                        params.put("nom",cad.getUser());
                        params.put("sen",cad.getSenha());
                        return params;
                    }
                };
        RequestQueue requestQueue = Volley.newRequestQueue(MainActivity.this);
        requestQueue.add(stringRequest);
        requestQueue.getCache().clear();


    }








}