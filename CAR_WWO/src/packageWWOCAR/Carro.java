
package packageWWOCAR;

public class Carro {
    // Atributos ( encapsulamento )
   private String nomeDoCarro;
   private String marcaDoCarro;
   private String corDoCarro;
   private String codigoDoCarro;
   private String estadoDoCarro;
   private double preco;
   private Boolean sinistro;
   
   // Metodos
   //getters
   public String getNomeDoCarro(){
    return this.nomeDoCarro;
}
    public String getMarcaDoCarro(){
    return this.marcaDoCarro;
}
    public String getCorDoCarro(){
    return this.corDoCarro;
}
    public String getCodigoDoCarro(){
    return this.codigoDoCarro;
}
    public String getEstadoDoCarro(){
    return this.estadoDoCarro;
}
    public double getPreco(){
    return this.preco;
}
    public Boolean getSinistro(){
    return this.sinistro;
}
    
    // setters
    public void setNomeDoCarro(String nomeDoCarro){
    this.nomeDoCarro = nomeDoCarro;
}
    public void setMarcaDoCarro(String marcaDoCarro){
    this.marcaDoCarro = marcaDoCarro;
}
     public void setCorDoCarro(String corDoCarro){
    this.corDoCarro = corDoCarro;
}
    public void setCodigoDoCarro(String codigoDoCarro){
    this.codigoDoCarro = codigoDoCarro;
}
    public void setEstadoDoCarro(String estadoDoCarro){
    this.estadoDoCarro = estadoDoCarro;
}
    public void setPreco(double preco){
    this.preco = preco;
}
    public void setSinistro(Boolean sinistro){
    this.sinistro = sinistro;
}
}

