import 'package:flutter/material.dart';
import 'package:viacep/cep_model.dart';
import 'package:viacep/cep_service.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  //==================================================
  final TextEditingController _cep = TextEditingController();
  final TextEditingController _logradouro = TextEditingController();
  final TextEditingController _bairro = TextEditingController();
  final TextEditingController _cidade = TextEditingController();
  final TextEditingController _uf = TextEditingController();
  final TextEditingController _regiao = TextEditingController();

  void exibirDados() async {
    CepModel? dadosRetorno = await CepService().buscarCep(_cep.text);

    _cep.text = dadosRetorno?.cep ?? "";
    _logradouro.text = dadosRetorno?.logradouro ?? "";
    _bairro.text = dadosRetorno?.bairro ?? "";
    _cidade.text = dadosRetorno?.localidade ?? "";
    _uf.text = dadosRetorno?.uf ?? "";
    _regiao.text = dadosRetorno?.regiao ?? "";
  }

  // Método responsável por criar o TextField estilizado de leitura
  Widget _buildCampoLeitura(
    TextEditingController controller,
    String rotulo,
    IconData icone,
  ) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12.0),
      child: TextField(
        controller: controller,
        readOnly: true,
        decoration: InputDecoration(
          labelText: rotulo,
          prefixIcon: Icon(icone, color: Colors.deepPurple),
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
          ),
          filled: true,
          fillColor: Colors.white,
        ),
      ),
    );
  }

  //==================================================
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromARGB(
        255,
        230,
        216,
        252,
      ), // <-- Adicione a cor de fundo aqui
      appBar: AppBar(
        title: const Text("API ViaCep"),
        backgroundColor: Colors.deepPurple, // OPCIONAL: altera a cor da AppBar
        foregroundColor: Colors.white,
      ),
      body: SingleChildScrollView(
        // Permite rolar a tela se o teclado abrir
        padding: const EdgeInsets.all(20.0), // Adiciona espaçamento nas bordas
        child: Column(
          children: [
            Text("Buscar Endereço ViaCep:"),
            SizedBox(height: 20),
            TextField(
              controller: _cep,
              decoration: InputDecoration(
                label: Text("Digite o CEP"),
                prefixIcon: const Icon(Icons.search),
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.circular(12),
                ),
                filled: true,
                fillColor: Colors.white,
              ),
            ),
            SizedBox(height: 20),
            ElevatedButton.icon(
              onPressed: exibirDados,              
              label: const Text("BUSCAR", style: TextStyle(fontSize: 18)),              
              style: ElevatedButton.styleFrom(
                backgroundColor: Colors.deepPurple,
                foregroundColor: Colors.white,
                
                padding: const EdgeInsets.symmetric(vertical: 28, horizontal: 28),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(100),
                ),
              ),
            ),
            const SizedBox(height: 24),
            
            // Chamadas repassando o ícone desejado
            _buildCampoLeitura(_logradouro, "Rua / Avenida", Icons.home),
            _buildCampoLeitura(_bairro, "Bairro", Icons.location_city),
            _buildCampoLeitura(_cidade, "Cidade", Icons.map),
            _buildCampoLeitura(_uf, "Estado", Icons.flag),
            _buildCampoLeitura(_regiao, "Região", Icons.explore),

            
          ],
        ),
      ),
    );
  }
}
