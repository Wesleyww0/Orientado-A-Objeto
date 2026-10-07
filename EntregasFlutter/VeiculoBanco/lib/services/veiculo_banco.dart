import 'package:sqflite/sqflite.dart';
import 'package:path/path.dart';
import 'package:listacontatos/models/veiculo_model.dart';

class VeiculoBanco {
  static final VeiculoBanco _instance = VeiculoBanco._internal();
  factory VeiculoBanco() => _instance;
  VeiculoBanco._internal();

  static Database? _db;

  Future<Database> get db async {
    if (_db != null) return _db!;
    _db = await _initDb();
    return _db!;
  }

  Future<Database> _initDb() async {
    String databasesPath = await getDatabasesPath();
    String path = join(databasesPath, 'veiculos.db');

    return await openDatabase(
      path,
      version: 1,
      onCreate: _onCreate,
    );
  }

  Future<void> _onCreate(Database db, int version) async {
    await db.execute('''
      CREATE TABLE veiculos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        modelo TEXT NOT NULL,
        marca TEXT NOT NULL,
        placa TEXT NOT NULL,
        valor REAL NOT NULL
      )
    ''');
  }

  Future<int> cadastrarVeiculo(VeiculoModel veiculo) async {
    Database dbClient = await db;
    return await dbClient.insert('veiculos', veiculo.toMap());
  }

  Future<List<VeiculoModel>> listarVeiculos() async {
    Database dbClient = await db;
    List<Map<String, dynamic>> maps = await dbClient.query('veiculos');
    return List.generate(maps.length, (i) => VeiculoModel.fromMap(maps[i]));
  }

  Future<int> atualizarVeiculo(VeiculoModel veiculo) async {
    Database dbClient = await db;
    return await dbClient.update(
      'veiculos',
      veiculo.toMap(),
      where: 'id = ?',
      whereArgs: [veiculo.id],
    );
  }

  Future<int> excluirVeiculo(int id) async {
    Database dbClient = await db;
    return await dbClient.delete(
      'veiculos',
      where: 'id = ?',
      whereArgs: [id],
    );
  }
}