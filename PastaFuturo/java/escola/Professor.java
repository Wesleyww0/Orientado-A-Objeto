package escola;

public class Professor extends Pessoa {
    private double salario;
    private String disciplina;

    public Professor(String nome, String cpf, Endereco endereco, double salario, String disciplina) {
        super(nome, cpf, endereco);
        this.salario = salario;
        this.disciplina = disciplina;
    }

    public void aula() {
        System.out.println("O professor " + getNome() + " está lecionando a disciplina de " + disciplina);
    }

    public double getSalario() { return salario; }
    public String getDisciplina() { return disciplina; }
}