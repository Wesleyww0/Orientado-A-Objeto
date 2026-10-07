import 'package:flutter/material.dart';
import 'package:listacontatos/models/veiculo_model.dart';
import 'package:listacontatos/services/veiculo_banco.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  //================================================
  List<VeiculoModel> _listarVeiculos = [];
  final VeiculoBanco _db = VeiculoBanco();

  final _nomeController = TextEditingController();
  final _descricaoController = TextEditingController();
  final _categoriaController = TextEditingController();
  final _valorController = TextEditingController();

  @override
  void initState() {
    super.initState();
    _carregarVeiculos();
  }

  void _carregarVeiculos() async {
    List<VeiculoModel> aux = await _db.listarVeiculos();
    setState(() {
      _listarVeiculos = aux;
    });
  }

  void _exibirDialogoFormulario({VeiculoModel? veiculo}) {
    if (veiculo != null) {
      _nomeController.text = veiculo.nome;
      _descricaoController.text = veiculo.descricao;
      _categoriaController.text = veiculo.categoria;
      _valorController.text = veiculo.valor.toString();
    } else {
      _nomeController.clear();
      _descricaoController.clear();
      _categoriaController.clear();
      _valorController.clear();
    }

    showDialog(
      context: context,
      builder: (context) {
        return AlertDialog(
          title: Text(veiculo == null ? "Cadastrar Veículo" : "Editar Veículo"),
          content: SingleChildScrollView(
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                TextField(
                  controller: _nomeController,
                  decoration: const InputDecoration(labelText: "nome"),
                ),
                TextField(
                  controller: _descricaoController,
                  decoration: const InputDecoration(labelText: "descricao"),
                ),
                TextField(
                  controller: _categoriaController,
                  decoration: const InputDecoration(labelText: "categoria"),
                ),
                TextField(
                  controller: _valorController,
                  keyboardType: const TextInputType.numberWithOptions(decimal: true),
                  decoration: const InputDecoration(labelText: "Valor"),
                ),
              ],
            ),
          ),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: const Text("Cancelar"),
            ),
            ElevatedButton(
              onPressed: () async {
                String nome = _nomeController.text;
                String descricao = _descricaoController.text;
                String categoria = _categoriaController.text;
                double valor = double.tryParse(_valorController.text) ?? 0.0;

                if (veiculo == null) {
                  await _db.cadastrarVeiculo(
                    VeiculoModel(
                      nome: nome,
                      descricao: descricao,
                      categoria: categoria,
                      valor: valor,
                    ),
                  );
                } else {
                  veiculo.nome = nome;
                  veiculo.descricao = descricao;
                  veiculo.categoria = categoria;
                  veiculo.valor = valor;
                  await _db.atualizarVeiculo(veiculo);
                }

                _carregarVeiculos();
                if (mounted) Navigator.pop(context);
              },
              child: const Text("Salvar"),
            ),
          ],
        );
      },
    );
  }

  void _deletar(int id) async {
    await _db.excluirVeiculo(id);
    _carregarVeiculos();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Cadastro de Veículos"),
        centerTitle: true,
      ),
      body: ListView.builder(
        itemCount: _listarVeiculos.length,
        itemBuilder: (context, index) {
          final item = _listarVeiculos[index];
          return ListTile(
            leading: const Icon(Icons.directions_car),
            title: Text("${item.descricao} - ${item.nome}"),
            subtitle: Text("categoria: ${item.categoria} | Valor: R\$ ${item.valor.toStringAsFixed(2)}"),
            trailing: Row(
              mainAxisSize: MainAxisSize.min,
              children: [
                IconButton(
                  icon: const Icon(Icons.edit, color: Colors.blue),
                  onPressed: () => _exibirDialogoFormulario(veiculo: item),
                ),
                IconButton(
                  icon: const Icon(Icons.delete, color: Colors.red),
                  onPressed: () => _deletar(item.id!),
                ),
              ],
            ),
          );
        },
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () => _exibirDialogoFormulario(),
        child: const Icon(Icons.add),
      ),
    );
  }
}
