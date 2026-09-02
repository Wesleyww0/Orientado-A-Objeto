package escola;

public abstract class Pessoa {
    private String nome;
    private String cpf;
    private Endereco endereco; // Composição: Toda Pessoa TEM UM Endereço

    public Pessoa(String nome, String cpf, Endereco endereco) {
        this.nome = nome;
        this.cpf = cpf;
        this.endereco = endereco;
    }

    public void aniversario() {
        System.out.println(this.nome + " está fazendo aniversário!");
    }

    public String getNome() { return nome; }
    public String getCpf() { return cpf; }
    public Endereco getEndereco() { return endereco; }
}