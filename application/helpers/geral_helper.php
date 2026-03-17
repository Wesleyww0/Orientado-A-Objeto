<?php
defined('BASEPATH') or exit('No direct script access allowed');
/* 
Função para verificar os parametros vindos do FrontEnd
 */

function verificaParam($atributos, $lista)
{
    //1º - Verificar se os elementos do Front estão nos atributos
    foreach ($lista as $key => $value) {
        if (array_key_exists($key, get_object_vars($atributos))) {
            $estatus = 1;
        } else {
            $estatus = 0;
            break;
        }
    }

    //2º - Verifica a quantidade de elementos
    if (count(get_object_vars($atributos)) != count($lista)) {
        $estatus = 0;
    }
    return $estatus;
}

/* 
Função para verificar os tipos de dados
 */
function validarDados($valor, $tipo, $tamanhoZero = true)
{

    //Verifica vazio ou nulo
    if (is_null($valor) || $valor === '') {
        return array('codigoHelper' => 2, 'msg' => 'Conteúdo nulo ou vazio.');
    }
    //Se considerar '0' como vazio
    if ($tamanhoZero && ($valor === 0 || $valor === '0')) {
        return array('codigoHelper' => 3, 'msg' => 'Conteúdo zerado.');
    }

    switch ($tipo) {
        case 'int':
            //filtra como inteiro aceita '123' ou 123
            if (filter_var($valor, FILTER_VALIDATE_INT) === false) {
                return array('codigoHelper' => 4, 'msg' => 'COnteúdo não inteiro.');
            }
            break;
        case 'string':
            //Garante que é string não vazia após trim
            if (!is_string($valor) || trim($valor) === '') {
                return array('codigoHelper' => 5, 'msg' => 'Conteúdo não é um texto.');
            }
            break;
        case 'date':
            //Verifico se tem padrão de data
            if (!preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $valor, $match)) {
                return array('codigoHelper' => 6, 'msg' => 'Data em formato inválido.');
            } else {
                //Tenta criar DataTime no formato Y-m-d
                $d = DateTime::createFromFormat('Y-m-d', $valor);
                if (($d->format('Y-m-d') === $valor) == false) {
                    return array('codigoHelper' => 6, 'msg' => 'Data Inválida.');
                }
            }
            break;
        case 'hora':
            //Verifico se tem padrão de hora
            if (preg_match('/^(?:[01]\d[2[0-3]):[0-5]\d$/', $valor)) {
                return array('codigoHelper' => 7, 'msg' => 'Hora em formato inválido.');
            }
            break;
        default:
            return array('codigoHelper' => 0, 'msg' => 'Tipo de dado não definido.');
    }
    //Valor defalt da váriavel $retorno caso não ocorra erro
    return array('codigoHelper' => 0, 'msg' => 'Validação Correta.');;
}
?>