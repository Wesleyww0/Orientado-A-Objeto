import 'package:flutter/material.dart';
import 'clima_model.dart';
import 'clima_service.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  final TextEditingController _cep = TextEditingController();
  final TextEditingController _cidade = TextEditingController();
  final TextEditingController _tempo = TextEditingController();
  final TextEditingController _regiao = TextEditingController();
  final TextEditingController _pais = TextEditingController();
  final TextEditingController _umidade = TextEditingController();
  final TextEditingController _vento = TextEditingController();
  final TextEditingController _periodo = TextEditingController();

  void exibirDados() async {
    ClimaModel? dadosRetorno = await ClimaService().buscarClimaPorCep(_cep.text);

    _cidade.text = dadosRetorno != null ? "${dadosRetorno.localidade} (${dadosRetorno.grausC.toStringAsFixed(0)}°C)" : "";
    _tempo.text = dadosRetorno?.condicaoDoTempo ?? "";
    _regiao.text = dadosRetorno?.regiao ?? "";
    _pais.text = dadosRetorno?.pais ?? "";
    _umidade.text = dadosRetorno != null ? "${dadosRetorno.umidade}%" : "";
    _vento.text = dadosRetorno?.vento ?? "";
    _periodo.text = dadosRetorno?.periodo ?? "";
  }

  // Helper simples para criar inputs com o visual limpo
  Widget _buildField(TextEditingController controller, String label, IconData icon) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12.0),
      child: TextField(
        controller: controller,
        readOnly: true,
        decoration: InputDecoration(
          prefixIcon: Icon(icon, color: Colors.blue),
          labelText: label,
          filled: true,
          fillColor: Colors.grey.shade200,
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(10),
            borderSide: BorderSide.none,
          ),
        ),
      ),
    );
  }

  //=====================================================================
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFECEFF1), // Fundo azul-acinzentado leve
      appBar: AppBar(
        title: const Text("API Tempo-BR", style: TextStyle(color: Colors.white)),
        backgroundColor: Colors.blue.shade900,
        centerTitle: true,
        elevation: 0,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20.0),
        child: Column(
          children: [
            // Bloco de Busca
            Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: Colors.grey.shade100,
                borderRadius: BorderRadius.circular(16),
                boxShadow: [
                  BoxShadow(
                    color: Colors.black.withOpacity(0.05),
                    blurRadius: 10,
                    offset: const Offset(0, 4),
                  )
                ],
              ),
              child: Row(
                children: [
                  Expanded(
                    child: TextField(
                      controller: _cep,
                      decoration: const InputDecoration(
                        hintText: "Digite a cidade",
                        border: InputBorder.none,
                        icon: Icon(Icons.search, color: Colors.blueGrey),
                      ),
                    ),
                  ),
                  ElevatedButton(
                    onPressed: () {
                      exibirDados();
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.blue.shade700,
                      foregroundColor: Colors.white,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(10),
                      ),
                    ),
                    child: const Text("Buscar"),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 24),

            // Bloco de Dados
            Container(
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(16),
                boxShadow: [
                  BoxShadow(
                    color: Colors.black.withOpacity(0.05),
                    blurRadius: 10,
                    offset: const Offset(0, 4),
                  )
                ],
              ),
              child: Column(
                children: [
                  _buildField(_cidade, "Cidade / Temp", Icons.location_city),
                  _buildField(_tempo, "Estado do tempo", Icons.wb_sunny_outlined),
                  _buildField(_regiao, "Região", Icons.map_outlined),
                  _buildField(_pais, "País", Icons.public),
                  _buildField(_umidade, "Umidade do Ar", Icons.water_drop_outlined),
                  _buildField(_vento, "Velocidade do Vento", Icons.air),
                  _buildField(_periodo, "Período", Icons.access_time),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}