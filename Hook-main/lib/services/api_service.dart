import 'dart:convert';
import 'package:http/http.dart' as http;

// 1. Classe de exceção personalizada
class ApiException implements Exception {
  final String mensagem;
  ApiException(this.mensagem);

  @override
  String toString() => mensagem;
}

class ApiService {
  // Construtor privado e Instância Singleton
  ApiService._();
  static final ApiService instance = ApiService._();

  // URL Base do Servidor
  static const String baseUrl = 'http://localhost:8080/api';

  // Endpoint de Cadastro
  Future<Map<String, dynamic>> cadastrar({
    required String nome,
    required String email,
    required String senha,
    required String tipo,
    String? telefone,
    String? placaGuincho,
  }) async {
    final url = Uri.parse('$baseUrl/cadastrar');

    try {
      final response = await http.post(
        url,
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'nome': nome,
          'email': email,
          'senha': senha,
          'tipo': tipo,
          'telefone': telefone,
          'placa_guincho': placaGuincho,
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 201 || response.statusCode == 200) {
        return data;
      } else {
        throw ApiException(
          data['messages'] ?? data['message'] ?? 'Erro no cadastro',
        );
      }
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Erro de conexão: $e');
    }
  }

  // Endpoint de Login
  Future<Map<String, dynamic>> login({
    required String email,
    required String senha,
  }) async {
    final url = Uri.parse('$baseUrl/login');

    try {
      final response = await http.post(
        url,
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'email': email,
          'senha': senha,
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200) {
        return data;
      } else {
        throw ApiException(
          data['messages'] ?? data['message'] ?? 'Falha ao autenticar',
        );
      }
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Erro de conexão: $e');
    }
  }

  // Endpoint de Criar Solicitação alinhado com a solicitar_servico_screen.dart
  Future<Map<String, dynamic>> criarSolicitacao({
    required dynamic veiculoId,
    required String tipoReboque,
    required String formaPagamento,
    required String endereco,
    required double latitude,
    required double longitude,
  }) async {
    final url = Uri.parse('$baseUrl/solicitacao');

    try {
      final response = await http.post(
        url,
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'veiculo_id': veiculoId,
          'tipo_reboque': tipoReboque,
          'forma_pagamento': formaPagamento,
          'endereco': endereco,
          'latitude': latitude,
          'longitude': longitude,
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 || response.statusCode == 201) {
        return data;
      } else {
        throw ApiException(
          data['messages'] ?? data['message'] ?? 'Erro ao criar solicitação',
        );
      }
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Erro de conexão: $e');
    }
  }

  // Endpoint de Consultar Solicitação
  Future<Map<String, dynamic>> consultarSolicitacao(dynamic id) async {
    final url = Uri.parse('$baseUrl/solicitacao/$id');

    try {
      final response = await http.get(url);
      final data = jsonDecode(response.body);

      if (response.statusCode == 200) {
        return data;
      } else {
        throw ApiException('Erro ao consultar solicitação');
      }
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Erro de conexão: $e');
    }
  }

  // Endpoint de Cancelar Solicitação
  Future<void> cancelarSolicitacao(dynamic id) async {
    final url = Uri.parse('$baseUrl/solicitacao/$id/cancelar');

    try {
      final response = await http.post(url);

      if (response.statusCode != 200) {
        final data = jsonDecode(response.body);
        throw ApiException(
          data['messages'] ?? data['message'] ?? 'Erro ao cancelar solicitação',
        );
      }
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Erro de conexão: $e');
    }
  }
}