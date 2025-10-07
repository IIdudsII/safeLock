package etec.com.br.eduardo.tcc;

public class CadRelacao {



    //Nome
    private String estado;
    public String getEstado() {
        return estado;
    }
    public void setEstado(String estado) {this.estado = estado;}

    //Pin
    private String horario;
    public String getHorario() {
        return horario ;
    }
    public void setHorario(String horario) {
        this.horario = horario;
    }

    private String data;
    public String getData() { return data ; }
    public void setData(String data) { this.data = data; }





    //Get e Set
    //Get - Pegar o Valor
    //Set - Inserir o Valor

    @Override
    public String toString(){
        return "\nEstado: " + getEstado() + "\nData: " + getData() + "\nHora: " + getHorario() + "\n";}

}
