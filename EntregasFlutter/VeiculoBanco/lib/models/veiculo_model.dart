class VeiculoModel {
  int? id;
  String modelo;
  String marca;
  String placa;
  double valor;

  VeiculoModel({
    this.id,
    required this.modelo,
    required this.marca,
    required this.placa,
    required this.valor,
  });

  Map<String, dynamic> toMap() {
    var map = <String, dynamic>{
      'modelo': modelo,
      'marca': marca,
      'placa': placa,
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
      modelo: map['modelo'],
      marca: map['marca'],
      placa: map['placa'],
      valor: map['valor'],
    );
  }
}