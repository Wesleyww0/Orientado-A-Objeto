import 'dart:convert';
import 'package:http/http.dart' as http;
import 'clima_model.dart';



class ClimaService {

  Future buscarClimaPorCep(String cep) async {
    String url = "http://viacep.com.br/ws/$cep/json/";
    http.Response response = await http.get(Uri.parse(url));
    
    if(response.statusCode == 200){
      Map<String, dynamic> dados = jsonDecode(response.body);
      return ClimaModel.fromJson(dados);      
    }
    return null;
  }

}