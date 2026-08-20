class ClimaModel {

  String localidade;
  String nome;
  String regiao;
  String pais;
  double grausC;
  String condicaoDoTempo;

  
  

  ClimaModel({
    required this.localidade,
    required this.nome, required this.regiao,
    required this.pais, required this.condicaoDoTempo, required this.grausC,
  });

  factory ClimaModel.fromJson(Map<String, dynamic> json){

    return ClimaModel(
      localidade: json['localidade'],
      nome: json['location']['name'], 
      regiao: json['location']['region'], 
      pais: json['location']['country'], 
      condicaoDoTempo: json['current']['condition']['text'], 
      grausC: json['current']['temp_c']
      );

  }


}