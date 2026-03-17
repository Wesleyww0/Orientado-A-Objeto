package packageWWOCAR;

public class Venda {
    // Atributos (Encapsulamento)
   private Double valorVenda;
   private String codigoVenda;
   
   // Metodos
   //getters
   public Double getValorVenda(){
    return this.valorVenda;
}
    public String getCodigoVenda(){
    return this.codigoVenda;
}
    // setters
    public void setValorVenda(Double valorVenda){
    this.valorVenda = valorVenda;
}
    public void setCodigoVenda(String codigoVenda){
    this.codigoVenda = codigoVenda;
}
    
    public double valorVendaComDesconto() {
        return this.valorVenda * 0.95;
    }
            
}

