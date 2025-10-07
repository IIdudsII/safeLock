package etec.com.br.eduardo.tcc;

public class CadUsuario {

    // Codigo Usuario
    private String codUser;
    public String getCodUser() {
        return codUser;
    }

    public void setCodUser(String codUser) {
        this.codUser = codUser;
    }

    //User
    private String user;
    public String getUser() {
        return user;
    }
    public void setUser(String user) {
        this.user = user;
    }

    //Cpf
    private String cpf;
    public String getCpf() {
        return cpf;
    }
    public void setCpf(String cpf) {
        this.cpf = cpf;
    }


    //Senha
    private  String senha;
    public String getSenha() {
        return senha;
    }
    public void setSenha(String senha) {
        this.senha = senha;
    }



    //Get e Set
    //Get - Pegar o Valor
    //Set - Inserir o Valor

    @Override
    public String toString(){
        return "User: " + getUser() + "\nSenha: " + getSenha();
    }
}
