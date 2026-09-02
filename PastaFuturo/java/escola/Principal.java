package escola;

public class Principal {
    public static void main(String[] args) {
        // 1. Criando endereços (Composição)
        Endereco end1 = new Endereco("Rua das Flores", "123", "São Paulo");
        Endereco end2 = new Endereco("Av. Brasil", "456", "Campinas");
        Endereco end3 = new Endereco("Rua dos Estudantes", "789", "Santos");

        System.out.println("--- 1. INSTANCIANDO PROFESSOR ---");
        Professor professor = new Professor("Carlos Eduardo", "111.222.333-44", end1, 5500.00, "Programação Orientada a Objetos");
        System.out.println("Professor: " + professor.getNome() + " | Disciplina: " + professor.getDisciplina() + " | Salário: R$ " + professor.getSalario());
        professor.aula();
        professor.aniversario();

        System.out.println("\n--- 2. INSTANCIANDO ALUNO REGULAR ---");
        Aluno alunoComum = new Aluno("Mariana Silva", "222.333.444-55", end2, "MAT-202401");
        alunoComum.adicionarNota(8.5);
        alunoComum.adicionarNota(7.0);
        alunoComum.adicionarNota(9.0);
        
        System.out.println("Aluno: " + alunoComum.getNome() + " | Matrícula: " + alunoComum.getMatricula());
        System.out.println("Endereço: " + alunoComum.getEndereco().getRua() + ", " + alunoComum.getEndereco().getNumero() + " - " + alunoComum.getEndereco().getCidade());
        System.out.println("Média final: " + alunoComum.media());

        System.out.println("\n--- 3. INSTANCIANDO ALUNO BOLSISTA ---");
        Bolsista bolsista = new Bolsista("Lucas Souza", "333.444.555-66", end3, "MAT-202402", 50.0);
        bolsista.adicionarNota(9.5);
        bolsista.adicionarNota(10.0);

        System.out.println("Bolsista: " + bolsista.getNome() + " | Matrícula: " + bolsista.getMatricula());
        System.out.println("Bolsa: " + bolsista.getPercentualBolsa() + "% de desconto");
        System.out.println("Média final: " + bolsista.media());
        bolsista.aniversario();
    }
}