package packageWWOCAR;

public class Vendedor extends Venda {
    // Atributos
    private String nome;
    private String codigoVendedor;
    
    // Metodos
   //getters
    public String getNome(){
    return this.nome;
}
    public String getCodigoVendedor(){
    return this.codigoVendedor;
}
    // setters
    public void setNome(String nome){
    this.nome = nome;
}
    public void setCodigoVendedor(String codigoVendedor){
    this.codigoVendedor = codigoVendedor;
}
    
}
