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
        $sql = "select codigo, descricao, capacidade, dataInicio,
        date_format(dataInicio, '%d-%m-%Y') dataInicioBr
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
}  public function alterar($codigo, $descricao, $capacidade, $dataInicio)
    {
        try {
            $retornoConsulta = $this->consultaTurmaCod($codigo);

            if ($retornoConsulta['codigo'] == 10) {

                $query = "UPDATE tbl_turma SET ";
                $updates = [];

                if ($descricao != "") {
                    $updates[] = "descricao = '$descricao'";
                }

                if ($capacidade != "") {
                    $updates[] = "capacidade = $capacidade";
                }

                if ($dataInicio != "") {
                    $updates[] = "dataInicio = '$dataInicio'";
                }

                $query .= implode(", ", $updates) . " WHERE codigo = $codigo";

                //prepara os valores para binding
                $params = [];
                if($descricao !== '') {
                    $params[] = $descricao;
                }
                if($capacidade !== '') {
                    $params[] = $capacidade;
                }
                if($dataInicio !== '') {
                    $params[] = $dataInicio;
                }
                $params[] = $codigo;

                //executa a query                
                $this->db->query($query);

                //verifica se a atualização foi bem sucedida

                if ($this->db->affected_rows() > 0) {
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
                'codigo' => 00, 
                'msg' => 'ATENÇÃO: o seguinte erro aconteceu -> ' . $e->getMessage()
            );  
        }
        return $dados;
    }

    public function desativar($codigo)
    {
        try {
            $retornoConsulta = $this->consultaTurmaCod($codigo);

            if ($retornoConsulta['codigo'] == 10) {

                $this->db->query("UPDATE tbl_turma SET status = 'D' WHERE codigo = $codigo");

                if ($this->db->affected_rows() > 0) {
                    return ['codigo' => 1, 'msg' => 'Turma desativada corretamente.'];
                } else {
                    return ['codigo' => 8, 'msg' => 'Erro ao desativar turma.'];
                }

            } else {
                return $retornoConsulta;
            }

        } catch (Exception $e) {
            return ['codigo' => 0, 'msg' => $e->getMessage()];
        }
    }

    public function consultaTurmaCod($codigo)
    {
        try {
            $sql = "SELECT * FROM tbl_turma WHERE codigo = $codigo";
            $retorno = $this->db->query($sql);

            if ($retorno->num_rows() > 0) {
                $linha = $retorno->row();

                if (trim($linha->estatus) == "D") {
                    return ['codigo' => 9, 'msg' => 'Turma desativada.'];
                }

                return ['codigo' => 10, 'msg' => 'OK'];
            }

            return ['codigo' => 12, 'msg' => 'Turma não encontrada.'];

        } catch (Exception $e) {
            return ['codigo' => 0, 'msg' => $e->getMessage()];
        }
    }
}