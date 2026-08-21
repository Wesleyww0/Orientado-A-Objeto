class ClimaModel {
  String localidade;
  String nome;
  String regiao;
  String pais;
  double grausC;
  String condicaoDoTempo;

  // 3 novos campos
  int umidade;
  String vento;
  String periodo;

  ClimaModel({
    required this.localidade,
    required this.nome,
    required this.regiao,
    required this.pais,
    required this.condicaoDoTempo,
    required this.grausC,
    required this.umidade,
    required this.vento,
    required this.periodo,
  });

  factory ClimaModel.fromJson(Map<String, dynamic> json) {
    final results = json['results'];

    return ClimaModel(
      localidade: results['city'] ?? '',
      nome: results['city_name'] ?? '',
      regiao: results['city'] ?? '',
      pais: 'Brasil',
      condicaoDoTempo: results['description'] ?? '',
      grausC: (results['temp'] as num).toDouble(),
      
      // Mapeamento dos novos campos
      umidade: (results['humidity'] as num).toInt(),
      vento: results['wind_speedy'] ?? '',
      periodo: results['currently'] == 'dia' ? 'Dia' : 'Noite',
    );
  }
}