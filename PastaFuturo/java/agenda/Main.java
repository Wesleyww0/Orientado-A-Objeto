package agenda;
import java.util.List;

public class Main {
    
    public static void main(String[] args) {
        Agenda agenda = new Agenda();

        System.out.println("--- 1. ADICIONANDO CONTATOS ---");
        agenda.adicionar(new Contato("Lucas Silva", "11999991111"));
        agenda.adicionar(new Contato("Mariana Souza", "11988882222"));
        agenda.adicionar(new Contato("Lucas Pereira", "11977773333"));
        System.out.println("Quantidade na agenda: " + agenda.quantidade());

        System.out.println("\n--- 2. BUSCANDO POR 'lucas' ---");
        List<Contato> resultadoBusca = agenda.buscarPorNome("lucas");
        for (Contato c : resultadoBusca) {
            System.out.println("Encontrado: " + c.getNome() + " - Tel: " + c.getTelefone());
        }

        System.out.println("\n--- 3. REMOVENDO CONTATO ---");
        boolean removido = agenda.remover("Mariana Souza");
        System.out.println("Mariana removida? " + removido);
        System.out.println("Quantidade após remoção: " + agenda.quantidade());

        System.out.println("\n--- 4. TESTE DA PEGADINHA (SEGURANÇA DA LISTA) ---");
        List<Contato> listaExterna = agenda.listarTodos();
        
        System.out.println("Tentando adicionar um contato diretamente na lista retornada por listarTodos()...");
        try {
            listaExterna.add(new Contato("Hacker", "000000000"));
            System.out.println("ERRO: A lista permitiu alteração externa!");
        } catch (UnsupportedOperationException e) {
            System.out.println("SUCESSO: Tentativa bloqueada! O Java lançou a exceção -> " + e.getClass().getSimpleName());
        }

        System.out.println("Quantidade final na agenda (permanece inalterada): " + agenda.quantidade());
    }
}