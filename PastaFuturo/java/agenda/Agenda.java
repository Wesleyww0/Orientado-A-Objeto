package agenda;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

public class Agenda {
    private final List<Contato> contatos;

    public Agenda() {
        this.contatos = new ArrayList<>();
    }

    public void adicionar(Contato c) {
        if (c != null) {
            this.contatos.add(c);
        }
    }

    public boolean remover(String nome) {
        if (nome == null) return false;
        return this.contatos.removeIf(c -> c.getNome().equalsIgnoreCase(nome));
    }

    public List<Contato> buscarPorNome(String parte) {
        List<Contato> encontrados = new ArrayList<>();
        if (parte == null || parte.trim().isEmpty()) {
            return encontrados;
        }

        for (Contato c : this.contatos) {
            if (c.getNome().toLowerCase().contains(parte.toLowerCase())) {
                encontrados.add(c);
            }
        }
        return encontrados;
    }

    public List<Contato> listarTodos() {
        return Collections.unmodifiableList(this.contatos);
    }

    public int quantidade() {
        return this.contatos.size();
    }
}