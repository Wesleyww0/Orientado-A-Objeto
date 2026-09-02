package escola;

public class Bolsista extends Aluno {
    private double percentualBolsa;

    public Bolsista(String nome, String cpf, Endereco endereco, String matricula, double percentualBolsa) {
        super(nome, cpf, endereco, matricula);
        this.percentualBolsa = percentualBolsa;
    }

    public double getPercentualBolsa() {
        return percentualBolsa;
    }

    public void setPercentualBolsa(double percentualBolsa) {
        this.percentualBolsa = percentualBolsa;
    }
}