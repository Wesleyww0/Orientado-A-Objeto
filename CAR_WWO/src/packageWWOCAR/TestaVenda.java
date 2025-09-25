package packageWWOCAR;

public class TestaVenda {

    public static void main(String[] args) {
        
        Vendedor ve = new Vendedor ();
        
        //atributos 
        ve.setNome("Mario Fontes");       
        ve.setCodigoVendedor("Fun055");
        ve.setValorVenda(84999.99);
        
        
        Coordenador co = new Coordenador ();
        
        //atributos 
        co.setNome("Fabio Junior");       
        co.setCodigoCordenador("Fun012");
        co.setValorVenda(84999.99);
        
        Cliente c = new Cliente ();
        
        //atributos 
        c.setNome("Amanda Vetorazzo");       
        c.setCodigoCliente("Cli143");
        c.setPagamento("Parcelamento 24x");
        
        Carro car = new Carro ();
        
        //atributos
        car.setNomeDoCarro ("Onix");
        car.setMarcaDoCarro ("Chevrolet");
        car.setCorDoCarro ("Branco");
        car.setCodigoDoCarro ("Car1042");
        car.setEstadoDoCarro ("Novo");
        car.setPreco (84999.99);
        car.setSinistro (false);
        
        Venda v = new Venda ();
        
        //atributos 
        v.setValorVenda(84999.99);
        v.setCodigoVenda("Ven1010");
        
        
        //Dados da Venda
        System.out.println("===============");
        System.out.println("Cliente");
        System.out.println("Nome: " + c.getNome());
        System.out.println("Codigo: " + c.getCodigoCliente());
        System.out.println("Forma de Pagamento: " + c.getPagamento());
        
        System.out.println("===============");
        System.out.println("Vendedor");
        System.out.println("Nome: " + ve.getNome());
        System.out.println("Codigo: " + ve.getCodigoVendedor());
        
        System.out.println("===============");
        System.out.println("Cordenador");
        System.out.println("Nome: " + co.getNome());
        System.out.println("Codigo: " + co.getCodigoCordenador());
        
        System.out.println("===============");
        System.out.println("Carro");
        System.out.println("Nome: " + car.getNomeDoCarro());
        System.out.println("Codigo: " + car.getCodigoDoCarro());
        System.out.println("Cor: " + car.getCorDoCarro());
        System.out.println("Marca: " + car.getMarcaDoCarro());
        System.out.println("Estado: " + car.getEstadoDoCarro());
        System.out.println("Sinistro: " + car.getSinistro());
        System.out.println("Preço: " + car.getPreco());
        
        System.out.println("===============");
        System.out.println("Venda");
        System.out.println("Codigo: " + v.getCodigoVenda());
        System.out.println("Valor: " + v.getValorVenda());
        System.out.println("===============");
        System.out.println("Se for Vendido pelo Vendedor pode ser ate: " + ve.valorVendaComDesconto());
        System.out.println("Se for Vendido pelo Coodenador pode ser ate: " + co.valorVendaComDesconto());
        
        
}
    
    
}
