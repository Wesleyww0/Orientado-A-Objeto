import 'package:listacontatos/models/contato_model.dart';
import 'package:sqflite/sqflite.dart'; // depois de baixar, importa
import 'package:path/path.dart';
 
class ContatoBanco {
  // baixar por terminal biblioteca do sqflite flutter pub add sqflite.. vai aparecer nas pasta pubspec.yaml
 
  Future<Database> iniciarBanco() async {
    return await openDatabase(
      // /data/data/<packege_name>/database/"contato.db"
      join(await getDatabasesPath(), 'contatos.db'),
      onCreate: (db, version) {
        return db.execute("""CREATE TABLE contatos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome Text,
            email Text,
            telefone Text
            )""");
      },
      version: 1
    );
  }
 
  Future<List<ContatoModel>> listarContatos() async {
    final db = await iniciarBanco();
    final List<Map<String, dynamic>> json = await db.query("contatos");
     return json.map((item) => ContatoModel.fromJson(item)).toList();
  }
 
  Future<bool> inserirContato(ContatoModel dadosContato) async {
    final db = await iniciarBanco();
    await db.insert("contatos", dadosContato.toJson());
    return true;
  }
 
  Future<bool> atualizarContato(ContatoModel dadosContato) async {
    final db = await iniciarBanco();
    await db.update(
        "contatos",
         dadosContato.toJson(),
         where: 'id = ?',
         whereArgs: [dadosContato.id],
         conflictAlgorithm: ConflictAlgorithm.replace    
    );
    return true;
  }
 
  Future<bool> deletarContato(int id) async {
    final db = await iniciarBanco();
    await db.delete(
        "contatos",
        where: 'id = ?',
        whereArgs: [id]
    );
    return true;
  }

  
}