
package packageEmpresa;


public class TestaFuncionario {

   
    public static void main(String[] args) {
        Funcionario f1 = new Funcionario();
        
        f1.nome = "João Da Silva Damasceno";
        f1.salario = 1500.55;
        
        Funcionario f2 = new Funcionario();
        
        f2.nome = "Heloisa Freitas Sales";
        f2.salario = 2500.85;
        
        // visualizando quanto recebia o func e quanto ele recebe com o metodo aumentaSalario
        System.out.println("-- AUMENTO DE SALARIO --");
        System.out.println("Funcionario(a): " + f1.nome);
        System.out.println("Recebia : " + f1.salario);
        f1.aumentaSalario(500);
        System.out.println("Agora Recebe : " + f1.salario);
        
        System.out.println("------------------------------------------------");
        
        System.out.println("Funcionario(a): " + f2.nome);
        System.out.println("Recebia: " + f2.salario);
        f2.aumentaSalario(200);
        System.out.println("Agora Recebe : " + f2.salario);
        
        System.out.println("------------------------------------------------");
        // Vizualizando as informaçoes dos funcionario com o metodo mostraFUncionsario
        System.out.println("-- iNFORMAÇOES GERAIS DOS FUNCIONARIOS --");
        f1.mostraFuncionario();
        System.out.println("------------------------------------------------");
        f2.mostraFuncionario();
    }
    
}
