<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_turma extends CI_Model
{
    /*
    Validação dos tipos de retornos nas validações (Código de erro)
    0 - Erro de exceção
    1 - Operação realizada no banco de dados com sucesso (Inserção, Alteração, Consulta ou Exclusão)
    8 - Houve algum problema de inserção, atualização, consulta ou exclusão
    9 - Turma desativada no sistema
    10 - Turma já cadastrada
    11 - Turma não encontrada pelo método publico
    98 - Método auxiliar de consulta que não trouxe dados
    */

    public function inserir($descricao, $capacidade, $dataInicio)
    {
        try {

            //Query de inserção dos dados
            $this->db->query("insert into tbl_turma (descricao, capacidade, dataInicio)
            values ('$descricao', $capacidade, '$dataInicio')");

            //Verificar se a inserção ocorreu com sucesso
            if ($this->db->affected_rows() > 0) {
                $dados = array(
                    'codigo' => 1,
                    'msg' => 'Turma cadastrada corretamente.'
                );
            } else {
                $dados = array(
                    'codigo' => 8,
                    'msg' => 'Houve algum problema na inserção na tabela de turma.'
                );
            }

        } catch (Exception $e) {
            $dados = array(
                'codigo' => 0,
                'msg' => 'ATENÇÃO: O seguinte erro aconteceu -> ' . $e->getMessage()
            );
        }

        return $dados;
    }

public function consultar($codigo, $descricao, $capacidade, $dataInicio)
{
    try {
        //Query para consultar dados de acordo com parâmetros passados
        $sql = "select codigo, descricao, capacidade,
        date_format(dataInicio, '%d-%m-%Y') dataIniciobra
        from tbl_turma where estatus = '' ";

        if (trim($codigo) != '') {
            $sql = $sql . " and codigo = $codigo ";
        }

        if (trim($descricao) != '') {
            $sql = $sql . " and descricao like '%$descricao%' ";
        }

        if (trim($capacidade) != '') {
            $sql = $sql . " and capacidade = $capacidade ";
        }

        if (trim($dataInicio != '')) {
            $sql = $sql . " and dataInicio = '$dataInicio' ";
        }

        $retorno = $this->db->query($sql);

        //Verificar se a consulta ocorreu com sucesso
        if ($retorno->num_rows() > 0) {
            $dados = array(
                'codigo' => 1,
                'msg' => 'Consulta efetuada com sucesso',
                'dados' => $retorno->result()
            );
        } else {
            $dados = array(
                'codigo' => 11,
                'msg' => 'Turma não encontrado.'
            );
        }

} catch (Exception $e) {
    $dados = array(
        'codigo' => 00,
        'msg' => 'ATENÇÃO: O seguinte erro aconteceu -> ' . $e->getMessage()
    );
}

//Envia o array $dados com as informações tratadas
//acima pela estrutura de decisão if
return $dados;
}  

public function alterar($codigo, $descricao, $capacidade, $dataInicio)
{
    try {
        $retornoConsulta = $this->consultaTurmaCod($codigo);

        if ($retornoConsulta['codigo'] == 10) {

            $query = "UPDATE tbl_turma SET ";
            $updates = [];
            $params = [];

            // Monta os campos usando '?' para o Binding seguro
            if ($descricao != '') {
                $updates[] = "descricao = ?";
                $params[] = $descricao;
            }

            if ($capacidade != '') {
                $updates[] = "capacidade = ?";
                $params[] = $capacidade;
            }

            if ($dataInicio != '') {
                $updates[] = "dataInicio = ?";
                $params[] = $dataInicio;
            }

            // Se nenhum campo foi alterado, evita rodar query vazia
            if (empty($updates)) {
                return array(
                    'codigo' => 8,
                    'msg' => 'Nenhum dado foi informado para alteração.'
                );
            }

            // Junta as partes da query
            $query .= implode(", ", $updates) . " WHERE codigo = ?";
            
            // O código precisa ser o último parâmetro do array por causa do WHERE
            $params[] = $codigo;

            // Executa a query de forma segura
            $this->db->query($query, $params);

            // Verifica se a atualização alterou alguma linha
            // Atenção: se salvar sem mudar nada, affected_rows pode ser 0. 
            // Se quiser que passe mesmo sem mudar valores, use >= 0
            if ($this->db->affected_rows() >= 0) {
                $dados = array(
                    'codigo' => 1, 
                    'msg' => 'Turma atualizada corretamente.'
                );                
            } else {
                $dados = array(
                    'codigo' => 8, 
                    'msg' => 'Houve algum erro na atualização da tabela da turma'
                );  
            } 

        } else {
            $dados = array(
                'codigo' => 5, 
                'msg' => 'Turma não cadastrada no sistema'
            );  
        }

    } catch (Exception $e) {
        $dados = array(
            'codigo' => 0, 
            'msg' => 'ATENÇÃO: o seguinte erro aconteceu -> ' . $e->getMessage()
        );  
    }
    return $dados;
}


    private function consultaTurmaCod($codigo)
    {
        try {
            // query para consultar dados de acordo com parametros passados
            $sql = "select * from tbl_turma where codigo = $codigo";

            $retornoTurma = $this->db->query($sql);

            // verificar se a consulta ocorreu com sucesso
            if ($retornoTurma->num_rows() > 0) {
                $linha = $retornoTurma->row();
                if (trim($linha->estatus) == "D") {
                    $dados = array(
                        'codigo' => 9, 
                        'msg' => 'Turma desativada no sistema'
                    );  
                }else{
                    $dados = array(
                        'codigo' => 10, 
                        'msg' => 'Consulta efetuada com sucesso'
                    );  
                }

                
            } else{
                $dados = array(
                    'codigo' => 12, 
                    'msg' => 'Turma não encontrada'
                );  
    
            }

           
        } catch (Exception $e) {
            $dados = array(
                'codigo' => 00, 
                'msg' => 'ATENÇÃO: o seguinte erro aconteceu -> ' . $e->getMessage()
            );  
        }
        return $dados;
    }

    public function desativar($codigo){
        try { 
            // veridica se a turma ja esta cadastrada
            $retornoConsulta = $this->consultaTurmaCod($codigo);

            if ($retornoConsulta['codigo'] == 10) {
                // query de atualização de dados
                $this->db->query("update tbl_turma set estatus = 'D' 
                                  where codigo = $codigo");
               // verifica se a tualização ocorreu com sucesso
                if ($this->db->affected_rows() > 0) {
                   $dados = array(
                    'codigo' => 1, 
                    'msg' => 'Turma desativada corretamente.'
                );

                } else {
                    $dados = array(
                        'codigo' => 8, 
                        'msg' => 'Houve algum problema na desativação da turma.'
                    );
                }

            } else {
                $dados = array(
                    'codigo' => $retornoConsulta ['codigo'], 
                    'msg' => $retornoConsulta ['msg']
                );
            }

        } catch (Exception $e) {
            $dados = array(
                'codigo' => 00, 
                'msg' => 'Atenção o seguinte erro aconteceu ->' . $e->getMessage()
            );
        }
         // envia o array dados construido a cima
        return $dados;
    }

    
}