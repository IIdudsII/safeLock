package etec.com.br.eduardo.tcc;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class notificacoes extends AppCompatActivity {

    ListView lsNotif;
    CadRelacao notificacao = new CadRelacao();
    private List<CadRelacao> listaNotificacoes = new ArrayList<>();
    private ArrayAdapter<CadRelacao> adaptadorNotificacao;
    public static String caminho = "http://" + MainActivity.ip + "/php/controller/relacao.controller.php?acao=";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notificacoes);

        lsNotif = findViewById(R.id.lstNotif);

        // Adicionando a função de rolagem ao ListView
        lsNotif.setChoiceMode(ListView.CHOICE_MODE_SINGLE);
        lsNotif.setItemsCanFocus(true);
        lsNotif.setScrollingCacheEnabled(false);
        lsNotif.setSmoothScrollbarEnabled(true);

        lsNotif.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {

            }
        });

        buscaCodigo(caminho + "consultar_Relacao");
    }

    private void buscaCodigo(String endereco) {
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest strRequest = new StringRequest(Request.Method.POST, endereco,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        listaNotificacoes.clear();
                        try {
                            JSONArray dados = new JSONArray(response);
                            for (int i = 0; i < dados.length(); i++) {
                                JSONObject jsonObj = dados.getJSONObject(i);

                                CadRelacao objNotif = new CadRelacao();
                                objNotif.setEstado(jsonObj.getString("estado"));
                                objNotif.setData(jsonObj.getString("data"));
                                objNotif.setHorario(jsonObj.getString("horario"));
                                listaNotificacoes.add(objNotif);
                            }
                        } catch (JSONException e) {
                            throw new RuntimeException(e);
                        }

                        adaptadorNotificacao = new ArrayAdapter<>(notificacoes.this, android.R.layout.simple_list_item_1, listaNotificacoes);
                        lsNotif.setAdapter(adaptadorNotificacao);
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(notificacoes.this, "Selecione uma Fechadura para Acessar as Notificações", Toast.LENGTH_SHORT).show();
                    }
                }
        ) {
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("cdFecha", devices.idF);
                return params;
            }
        };
        queue.add(strRequest);
    }

    public void clicarDevices(View view) {
        Intent abrirTelaDevices = new Intent(notificacoes.this, devices.class);
        finish();
        startActivity(abrirTelaDevices);
    }

    public void clicarHome(View view) {
        Intent abrirTelaApp = new Intent(notificacoes.this, Aplicativo.class);
        finish();
        startActivity(abrirTelaApp);
    }

    public void clicarNotif(View view) {
        Intent abrirTelaApp = new Intent(notificacoes.this, notificacoes.class);
        finish();
        startActivity(abrirTelaApp);
    }
}
