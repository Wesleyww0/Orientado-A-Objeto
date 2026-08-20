<?php
// Configuração de cabeçalhos para aceitar requisições em JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Responde requisições de preflight do CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Configurações do Banco de Dados no XAMPP
$host = "localhost";
$db_name = "hook_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name . ";charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro na conexão com o banco de dados: " . $e->getMessage()
    ]);
    exit();
}

// Obtém o corpo da requisição enviada pelo Flutter
$dados = json_decode(file_get_contents("php://input"), true);

if (!$dados) {
    http_response_code(400);
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Nenhum dado enviado."
    ]);
    exit();
}

// Validação dos campos obrigatórios
$nome = isset($dados['nome']) ? trim($dados['nome']) : null;
$email = isset($dados['email']) ? trim($dados['email']) : null;
$senha = isset($dados['senha']) ? trim($dados['senha']) : null;
$tipo = isset($dados['tipo']) ? trim($dados['tipo']) : 'cliente'; // Padrão: cliente

if (empty($nome) || empty($email) || empty($senha)) {
    http_response_code(400);
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Preencha todos os campos obrigatórios (nome, e-mail e senha)."
    ]);
    exit();
}

try {
    // 1. Verifica se o e-mail já está cadastrado
    $stmtVerifica = $conn->prepare("SELECT id FROM usuarios WHERE email = :email LIMIT 1");
    $stmtVerifica->bindParam(":email", $email);
    $stmtVerifica->execute();

    if ($stmtVerifica->rowCount() > 0) {
        http_response_code(400);
        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Este e-mail já está cadastrado."
        ]);
        exit();
    }

    // 2. Criptografa a senha para salvar no campo 'senha_hash'
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Campos opcionais
    $telefone = isset($dados['telefone']) ? trim($dados['telefone']) : null;
    $cpf_cnpj = isset($dados['cpf_cnpj']) ? trim($dados['cpf_cnpj']) : null;
    $tipo_atuacao = isset($dados['tipo_atuacao']) ? trim($dados['tipo_atuacao']) : null;
    $servicos = isset($dados['servicos']) ? trim($dados['servicos']) : null;
    $placa_guincho = isset($dados['placa_guincho']) ? trim($dados['placa_guincho']) : null;

    // 3. Insere o novo usuário no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha_hash, tipo, telefone, cpf_cnpj, tipo_atuacao, servicos, placa_guincho) 
            VALUES (:nome, :email, :senha_hash, :tipo, :telefone, :cpf_cnpj, :tipo_atuacao, :servicos, :placa_guincho)";
    
    $stmtInsert = $conn->prepare($sql);
    $stmtInsert->bindParam(":nome", $nome);
    $stmtInsert->bindParam(":email", $email);
    $stmtInsert->bindParam(":senha_hash", $senha_hash);
    $stmtInsert->bindParam(":tipo", $tipo);
    $stmtInsert->bindParam(":telefone", $telefone);
    $stmtInsert->bindParam(":cpf_cnpj", $cpf_cnpj);
    $stmtInsert->bindParam(":tipo_atuacao", $tipo_atuacao);
    $stmtInsert->bindParam(":servicos", $servicos);
    $stmtInsert->bindParam(":placa_guincho", $placa_guincho);

    if ($stmtInsert->execute()) {
        $novoId = $conn->lastInsertId();

        // Resposta de sucesso formatada para o Flutter
        http_response_code(201);
        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Conta criada com sucesso!",
            "usuario" => [
                "id" => (int)$novoId,
                "nome" => $nome,
                "email" => $email,
                "tipo" => $tipo,
                "telefone" => $telefone,
                "placa_guincho" => $placa_guincho
            ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Não foi possível criar a conta."
        ]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao cadastrar usuário: " . $e->getMessage()
    ]);
}