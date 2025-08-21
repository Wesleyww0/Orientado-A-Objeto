
package packageEmpresa;


public class Funcionario {
    //Estado - atributo
    String nome;
    Double salario;
    
    //Metodo - COmportamento
    //aumentaSalario
    void aumentaSalario (double valor){
        this.salario += valor;
    }
    //mostraFuncionario
   void mostraFuncionario (){
        System.out.println("O funcionario: " + this.nome );
        System.out.println("Recebe: " + this.salario);
   }
}
