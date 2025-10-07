package etec.com.br.eduardo.tcc;

public class CadFecha {
    private String codFecha;
    public String getCodFecha() {
        return codFecha;
    }

    public void setCodFecha(String codFecha) {
        this.codFecha = codFecha;
    }

    //Nome
    private String nome;
    public String getNome() {
        return nome;
    }
    public void setNome(String nome) {
        this.nome = nome;
    }

    //Pin
    private String pin;
    public String getPin() {
        return pin;
    }
    public void setPin(String pin) {
        this.pin = pin;
    }

    private String id;
    public String getId() {return id;}
    public void setId(String id) {this.id = id;}




    //Get e Set
    //Get - Pegar o Valor
    //Set - Inserir o Valor

    @Override
    public String toString(){
        return "Nome: " + getNome() + "\nPIN: " + getPin();}


}
