import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:viacep/cep_model.dart';

class CepService {

  Future buscarCep(String cep) async {
    String url = "http://viacep.com.br/ws/$cep/json/";
    http.Response response = await http.get(Uri.parse(url));
    
    if(response.statusCode == 200){
      Map<String, dynamic> dados = jsonDecode(response.body);
      return CepModel.fromJson(dados);      
    }
    return null;
  }

}