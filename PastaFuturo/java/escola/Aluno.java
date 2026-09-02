package escola;

import java.util.ArrayList;
import java.util.List;

public class Aluno extends Pessoa {
    private String matricula;
    private List<Double> notas;

    public Aluno(String nome, String cpf, Endereco endereco, String matricula) {
        super(nome, cpf, endereco);
        this.matricula = matricula;
        this.notas = new ArrayList<>();
    }

    public void adicionarNota(double nota) {
        this.notas.add(nota);
    }

    public double media() {
        if (notas.isEmpty()) return 0.0;
        double soma = 0;
        for (double n : notas) {
            soma += n;
        }
        return soma / notas.size();
    }

    public String getMatricula() { return matricula; }
    public List<Double> getNotas() { return new ArrayList<>(notas); }
}