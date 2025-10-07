package etec.com.br.eduardo.tcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.JsonWriter;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class devices extends AppCompatActivity {

    ListView lsFechadura;

    CadFecha fechadura = new CadFecha();
    private List<CadFecha> listaFechaduras = new ArrayList<>();
    private ArrayAdapter<CadFecha> adaptadorFechadura;
    public static String caminho = "http://" + MainActivity.ip + "/php/controller/fechadura.controller.php?acao=";

    public static String nome, idF;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_devices);

        lsFechadura = findViewById(R.id.lstFechaduras);


        lsFechadura.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                 fechadura = (CadFecha) parent.getItemAtPosition(position);


                CadFecha cf = new CadFecha();
                cf = listaFechaduras.get(position);

                nome = cf.getNome();
                idF = cf.getId();

                Intent abrirTelaApp = new Intent(devices.this, Aplicativo.class);
                finish();
                startActivity(abrirTelaApp);

            }
        });
//chamada do método que mostra os dados na ListView (lstPessoal)
        buscaCodigo(caminho + "consultar_Fechadura");


    }













    private void buscaCodigo(String endereco){
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest strRequest = new
                StringRequest(Request.Method.POST, endereco,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                listaFechaduras.clear();
                                Log.e("teste", response);
                                try {
                                    JSONArray dados = new JSONArray(response) ;
                                    for (int i = 0; i < dados.length(); i++)
                                    {
                                        JSONObject jsonObj = dados.getJSONObject(i);

                                        CadFecha objPessoa = new CadFecha();
                                        objPessoa.setNome(jsonObj.getString("nome"));
                                        objPessoa.setPin(jsonObj.getString("pin"));
                                        objPessoa.setId(jsonObj.getString("idFechadura"));
                                        //Log.e("teste",objPessoa.getNome());
                                        listaFechaduras.add(objPessoa);
                                    }
                                } catch (JSONException e) {
                                    throw new RuntimeException(e);
                                }

                                adaptadorFechadura = new ArrayAdapter<CadFecha>(devices.this, android.R.layout.simple_list_item_1, listaFechaduras);
                                lsFechadura.setAdapter(adaptadorFechadura);
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(devices.this,
                                        error.toString(), Toast.LENGTH_SHORT).show();
                            }
                        }
                ){
                    protected Map<String, String> getParams(){
                        Map<String, String> params = new HashMap<>();
                        params.put("cdUser",MainActivity.codUser);
                        return params;
                    }
                };
        queue.add(strRequest);
    }




    public void clicarCadFecha(View view)
    {
        Intent abrirTelaFechadura = new Intent(devices.this, cadFechadura.class);
        finish();
        startActivity(abrirTelaFechadura);
    }
    public void clicarDevices(View view)
    {
        Intent abrirTelaDevices = new Intent(devices.this, devices.class);
        finish();
        startActivity(abrirTelaDevices);
    }

    public void clicarHome(View view)
    {
        Intent abrirTelaApp = new Intent(devices.this, Aplicativo.class);
        finish();
        startActivity(abrirTelaApp);

    }

    public void clicarNotif(View view)
    {
        Intent abrirTelaApp = new Intent(devices.this, notificacoes.class);
        finish();
        startActivity(abrirTelaApp);

    }



}