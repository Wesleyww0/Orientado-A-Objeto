import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
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
  

  void exibirDados() async {
    ClimaModel? dadosRetorno = await ClimaService().buscarClimaPorCep(_cep.text);

    _cidade.text = dadosRetorno?.localidade ?? "";
    _tempo.text = dadosRetorno?.condicaoDoTempo ?? "";
    _regiao.text = dadosRetorno?.regiao ?? "";
    _pais.text = dadosRetorno?.pais ?? "";
  }

  //===========================Códiguin==========================================
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("API via Weather", style: TextStyle(color: Colors.white)),
        backgroundColor: Colors.black54,
      ),
      body: Column(
        children: [
          Row(
            children: [
              Expanded(
                child: TextField(
                  controller: _cidade,
                  decoration: InputDecoration(
                    label: Text("Digite o nome da cidade"),
                  ),
                ),
              ),
              ElevatedButton(
                onPressed: () {
                  exibirDados();
                },
                child: Text("Buscar"),
              ),
            ],
          ),

          SizedBox(height: 40),

         

          TextField(
            controller: _tempo,
            decoration: InputDecoration(label: Text("Estado do tempo")),
          ),
          SizedBox(height: 20),

          

          TextField(
            controller: _regiao,
            decoration: InputDecoration(label: Text("Região")),
          ),
          SizedBox(height: 20),

          TextField(
            controller: _pais,
            decoration: InputDecoration(label: Text("Pais")),
          ),
          SizedBox(height: 20),
        ],
      ),
    );
  }
}
