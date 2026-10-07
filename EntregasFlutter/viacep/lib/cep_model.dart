class CepModel {
  String cep;
  String logradouro;
  String localidade;
  String? complemento;
  String bairro;
  String uf;
  String estado;
  String regiao;
 
  CepModel({required this.cep, required this.logradouro, required this.localidade, this.complemento, required this.bairro, required this.uf, required this.estado, required this.regiao});
 
  factory CepModel.fromJson(Map<String, dynamic> json) {
    return CepModel(
      cep: json['cep'],
      logradouro: json['logradouro'],
      localidade: json['localidade'],
      bairro: json['bairro'],
      uf: json['uf'],
      estado: json['estado'],
      regiao: json['regiao'],
      complemento: json['complemento'],
    );
  }
}