package packageWWOCAR;

public class Cliente {
    // Atributos
    private String nome;
    private String codigoCliente;
    private String pagamento;
    
    // Metodos
   //getters
    public String getNome(){
    return this.nome;
}
    public String getCodigoCliente(){
    return this.codigoCliente;
}
    public String getPagamento(){
    return this.pagamento;
}
    // setters
    public void setNome(String nome){
    this.nome = nome;
}
    public void setCodigoCliente(String codigoCliente){
    this.codigoCliente = codigoCliente;
}
    public void setPagamento(String pagamento){
    this.pagamento = pagamento;
}
}
