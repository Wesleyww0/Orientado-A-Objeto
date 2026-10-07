import 'package:flutter/material.dart';
 
class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});
 
  @override
  State<HomeScreen> createState() => _HomeScreenState();
}
 
class _HomeScreenState extends State<HomeScreen> {
  //////////////////////////////////Variaveis - Funçoes/// --
  final _nomeController = TextEditingController();
  final _emailController = TextEditingController();
  final _telefoneController = TextEditingController();
 
  ///----
 
  void abrirFormulario(contato) {
    showDialog(
      context: context, // onde abre
      builder: (context) {
        // contruir // onde contruir.. contruir no context.. no caso, na pagina atual
        return AlertDialog(
          title: Text("Cadastro"),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              TextField(
                controller: _nomeController,
                decoration: InputDecoration(label: Text("Nome")),
              ),
              SizedBox(height: 20),
              TextField(
                controller: _emailController,
                decoration: InputDecoration(label: Text("Email")),
              ),
              SizedBox(height: 20),
              TextField(
                controller: _telefoneController,
                decoration: InputDecoration(label: Text("Telefone")),
              ),
              SizedBox(height: 20),
 
              // ElevatedButton(onPressed: (){}, child: Text("Salvar")),
            ],
          ),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: Text("Cancelar"),
            ),
            TextButton(onPressed: () {}, child: Text("Salvar")),
          ],
        );
      },
    );
  }
 
  ////////////////////////////////////////////////////////////////////////
 
  @override
  Widget build(BuildContext context) {
    //sempre que tem return.. ; no final
    return Scaffold(
      appBar: AppBar(title: Text("Lista de Contatos")),
      body: ListView.builder(
        itemCount: 5,
        itemBuilder: (context, index) {
          return Card(
            margin: EdgeInsets.symmetric(horizontal: 10, vertical: 5),
            child: ListTile(
              title: Text('Test'),
              subtitle: Text('Test'),
 
              trailing: IconButton(
                onPressed: () {},
                icon: Icon(Icons.mode_edit_outline_outlined),
              ),
 
              leading: CircleAvatar(child: Icon(Icons.personal_injury_rounded)),
            ),
          );
        },
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          abrirFormulario(null);
        },
        child: Icon(Icons.add_reaction_outlined),
      ),
    );
  }
}