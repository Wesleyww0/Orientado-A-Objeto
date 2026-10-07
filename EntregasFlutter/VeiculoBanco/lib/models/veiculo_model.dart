class VeiculoModel {
  int? id;
  String nome;
  String descricao;
  String categoria;
  double valor;

  VeiculoModel({
    this.id,
    required this.nome,
    required this.descricao,
    required this.categoria,
    required this.valor,
  });

  Map<String, dynamic> toMap() {
    var map = <String, dynamic>{
      'nome': nome,
      'descricao': descricao,
      'categoria': categoria,
      'valor': valor,
    };
    if (id != null) {
      map['id'] = id;
    }
    return map;
  }

  factory VeiculoModel.fromMap(Map<String, dynamic> map) {
    return VeiculoModel(
      id: map['id'],
      nome: map['nome'],
      descricao: map['descricao'],
      categoria: map['categoria'],
      valor: map['valor'],
    );
  }
}
