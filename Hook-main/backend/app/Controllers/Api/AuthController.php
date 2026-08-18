<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuarioModel;

class AuthController extends ResourceController
{
    protected $format = 'json';

    // POST /auth/cadastrar
    public function cadastrar()
    {
        $usuarioModel = new UsuarioModel();
        $rules = [
            'nome'     => 'required|min_length[3]|max_length[120]',
            'email'    => 'required|valid_email|is_unique[usuarios.email]',
            'senha'    => 'required|min_length[6]',
            'tipo'     => 'required|in_list[cliente,motorista]',
            'telefone' => 'permit_empty|string'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $dados = $this->request->getPost();

        // Se o tipo for motorista, valida e atribui a placa do guincho
        if ($dados['tipo'] === 'motorista' && !empty($dados['placa_guincho'])) {
            $dados['placa_guincho'] = strtoupper($dados['placa_guincho']);
        } else {
            $dados['placa_guincho'] = null;
        }

        // Gera o token de acesso inicial
        $dados['api_token'] = bin2hex(random_bytes(32));

        if ($usuarioModel->insert($dados)) {
            $id = $usuarioModel->getInsertID();
            $usuario = $usuarioModel->find($id);
            unset($usuario['senha_hash']);

            return $this->respondCreated([
                'status'  => true,
                'message' => 'Usuário cadastrado com sucesso!',
                'usuario' => $usuario
            ]);
        }

        return $this->failServerError('Não foi possível realizar o cadastro.');
    }

    // POST /auth/login
    public function login()
    {
        $usuarioModel = new UsuarioModel();

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        if (empty($email) || empty($senha)) {
            return $this->fail('E-mail e senha são obrigatórios.', 400);
        }

        // Busca o usuário pelo e-mail
        $usuario = $usuarioModel->where('email', $email)->first();

        if (!$usuario) {
            return $this->failNotFound('Usuário não encontrado.');
        }

        // Valida o hash da senha
        if (!password_verify($senha, $usuario['senha_hash'])) {
            return $this->failUnauthorized('Credenciais inválidas.');
        }

        // Gera um novo token para a sessão
        $novoToken = bin2hex(random_bytes(32));
        $usuarioModel->update($usuario['id'], ['api_token' => $novoToken]);

        // Prepara resposta sem expor o hash da senha
        unset($usuario['senha_hash']);
        $usuario['api_token'] = $novoToken;

        return $this->respond([
            'status'  => true,
            'message' => 'Login realizado com sucesso!',
            'usuario' => $usuario
        ], 200);
    }
}