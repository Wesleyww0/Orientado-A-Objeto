
import java.util.ArrayList;
import java.util.List;

public class Aluno {

    private String nome;
    private int idade;
    private double nota;
    private List<String> disciplinas;

    public boolean aprovado() {
        return nota >= 7.0;
    }

    public Aluno(String nome, int idade, double nota) {
        if (nome == null || nome.trim().isEmpty()) {
            throw new IllegalArgumentException("O nome não pode ser vazio ou nulo");
        }
        if (idade < 0 || idade > 130){
            throw new IllegalArgumentException("A idade precisa estar entre 0 e 130");
        }
        if (nota < 0 || nota > 10){
            throw new IllegalArgumentException("A nota precisa estar entre 0 e 10");
        }

         this.nome = nome;
        this.idade = idade;
        this.nota = nota;
        this.disciplinas = new ArrayList<>();
        
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public int getIdade() {
        return idade;
    }

    public void setIdade(int idade) {
        this.idade = idade;
    }

     public double getNota() {
        return nota;
    }

    public void setNota(double nota) {
        this.nota = nota;
    }

    public List<String> getDisciplinas() {
        return disciplinas;
    }

    public void setDisciplinas(List<String> disciplinas) {
        this.disciplinas = disciplinas;
    }

    // teste, resposta no terminal..
    public static void main(String[] args) {

        // aluno lucas
    Aluno aluno1 = new Aluno("Lucas", 28, 4.0);
    
    System.out.println(
        "O aluno: " + aluno1.getNome() + 
        " que tem: " + aluno1.getIdade() + " anos, " +
        "teve a nota: " + aluno1.getNota() + 
        ". Foi aprovado? " + (aluno1.aprovado() ? "Sim" : "Nao")
    );

    // aluno Gabriela
    Aluno aluno2 = new Aluno("Gabriela", 22, 8.0);
    
    System.out.println(
        "O aluno: " + aluno2.getNome() + 
        " que tem: " + aluno2.getIdade() + " anos, " +
        "teve a nota: " + aluno2.getNota() + 
        ". Foi aprovado? " + (aluno2.aprovado() ? "Sim" : "Nao")
    );

    
}



    

   
}

// aluno.idade = -3;
// aluno.nota = 42.0;
// 1 Torne todos os atributos privados
// 2 Crie um construtor que valide os dados
// 3 Idade entre 0 e 130; nota entre 0 e 10
// 4 O nome não pode ser vazio
// 5 Decida quais campos precisam de setter
// 6 Não devolva a lista interna diretamente



