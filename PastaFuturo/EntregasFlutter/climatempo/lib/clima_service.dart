import 'dart:convert';
import 'package:http/http.dart' as http;
import 'clima_model.dart';

class ClimaService {
  Future buscarClimaPorCep(String cidade) async {
    String apiKey = "a41bcae2"; 
    String cidadeFormatada = Uri.encodeComponent(cidade.trim());
    
    String url = "https://api.hgbrasil.com/weather?key=$apiKey&city_name=$cidadeFormatada";

    http.Response response = await http.get(Uri.parse(url));

    if (response.statusCode == 200) {
      Map<String, dynamic> dados = jsonDecode(response.body);
      
      if (dados['results'] != null) {
        return ClimaModel.fromJson(dados);
      }
    }
    return null;
  }
}