<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    protected $allowedFields    = [
        'nome',
        'email',
        'senha_hash',
        'tipo',
        'telefone',
        'placa_guincho',
        'disponivel',
        'latitude_atual',
        'longitude_atual',
        'api_token'
    ];

    // Mapeamento automático de datas (created_at e updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks para hash da senha antes de inserir ou atualizar
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['senha'])) {
            $data['data']['senha_hash'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
            unset($data['data']['senha']);
        }
        return $data;
    }
}