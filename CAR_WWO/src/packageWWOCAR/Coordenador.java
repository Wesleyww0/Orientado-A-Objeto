package packageWWOCAR;

public class Coordenador extends Venda {
   // Atributos
    private String nome;
    private String codigoCordenador;
    
    // Metodos
   //getters
    public String getNome(){
    return this.nome;
}
    public String getCodigoCordenador(){
    return this.codigoCordenador;
}
    // setters
    public void setNome(String nome){
    this.nome = nome;
}
    public void setCodigoCordenador(String codigoCordenador){
    this.codigoCordenador = codigoCordenador;
} 
    @Override
    public double valorVendaComDesconto() {
        return this.getValorVenda() * 0.90;
    }
}
