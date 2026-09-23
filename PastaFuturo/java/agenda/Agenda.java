package agenda;

import java.util.ArrayList;
import java.util.List;

public class Agenda {
    private final List<Contato> contatos;

    public Agenda() {
        this.contatos = new ArrayList<>();
    }

    // Adicionar(Contato c)
    public void adicionar(Contato c) {
        if (c != null) {
            this.contatos.add(c);
        }
    }

    // Remover(String nome)
    public boolean remover(String nome) {
        if (nome == null) return false;
        
        // Uso de removeIf (ou iterator), remove pelo nome ignorando case
        return this.contatos.removeIf(c -> c.getNome().equalsIgnoreCase(nome));
    }

    // BuscarPorNome(String parte) - Uso de for-each
    public List<Contato> buscarPorNome(String parte) {
        List<Contato> encontrados = new ArrayList<>();
        if (parte == null || parte.trim().isEmpty()) {
            return encontrados;
        }

        // USO DO FOR-EACH
        for (Contato c : this.contatos) {
            if (c.getNome().toLowerCase().contains(parte.toLowerCase())) {
                encontrados.add(c);
            }
        }
        return encontrados;
    }

    // ListarTodos() - devolve uma CÓPIA para proteger o encapsulamento
    public List<Contato> listarTodos() {
        return new ArrayList<>(this.contatos);
    }

    // Quantidade()
    public int quantidade() {
        return this.contatos.size();
    }
}