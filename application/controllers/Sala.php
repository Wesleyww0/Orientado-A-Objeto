<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sala extends CT_Controller{
    // Validação dos tipos de retorno das valçidações ( Codihgo de erro )
    //1 Operação realizada
    //2 conteudo nulo/vazio
    //3zerado
    //4 n inteiro
    //5 n é txt
    //6 data formato errado
    //7 hora formato errado
    //99 parametro erro com front

    //Atributos privados da classe
    private $codigo;
    private $descricao;
    private $andar;
    private $capacidade;
    private $estatus;

    //Getters dos atributos
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getAndar()
    {
        return $this->andar;
    }
    
    public function getCapacidade()
    {
        return $this->capacidade;
    }
    
    public function getEstatus()
    {
        return $this->estatus;
    }

    //setter dos atrubutos
    public function setCodigo($codigoFront)
    {
        $this->codigo = $codigoFront;
    }
    
    public function setDescricao($descricaoFront)
    {
        $this->descricao = $descricaoFront;
    }

    public function setAndar($andarFront)
    {
        $this->andar = $andarFront;
    }

    public function setCapacidade($capacidadeFront)
    {
        $this->capacidade = $capacidadeFront;
    }

    public function setEstatus($estatusFront)
    {
        $this->estatus = $estatusFront;
    }

    public function inserir() {
        //Atributos p/ controlar o status do nosso metodo
        $erros = [];
        $sucesso = false;

        try {
            $json = file_get_contents('php://input');
            $resultado = json_decode($json);
            $lista = [
                "codigo" => '0',
                "descricao" => '0',
                "andar" => '0',
                "capacidade" => '0'
            ];

            if (verificaParam($resultado, $lista) != 1){
                $erros[] = ['codigo' => 99, 'msg' => 'Campos inexistentes ou incorretos no FrontEnd'];                
            }else{
                //Validade campos qt ao tipo de dados e tamanho (helper)
                $retornoCodigo = verificaParam($resultado->codigo,'int',true);
                $retornoDescricao = verificaParam($resultado->descricao,'string',true);
                $retornoAndar = validarDados($resultado->andar,'int',true);
                $retornoCapacidade = verificaParam($resultado->capacidade,'int',true);

                if($retornoCodigo['codigoHelper'] !=0){
                    $erros[] = ['codigo'=> $retornoCodigo['codigoHelper'],
                                'campo' => 'Codigo',
                                'msg' => $retornoCodigo['msg']];
                }

                if($retornoDescricao['codigoHelper'] !=0){
                    $erros[] = ['codigo'=> $retornoDescricao['codigoHelper'],
                                'campo' => 'Descricao',
                                'msg' => $retornoDescricao['msg']];
                }

                if($retornoAndar['codigoHelper'] !=0){
                    $erros[] = ['codigo'=> $retornoAndar['codigoHelper'],
                                'campo' => 'Andar',
                                'msg' => $retornoAndar['msg']];
                }

                if($retornoCapacidade['codigoHelper'] !=0){
                    $erros[] = ['codigo'=> $retornoCapacidade['codigoHelper'],
                                'campo' => 'Capacidade',
                                'msg' => $retornoCapacidade['msg']];
                }
                // se n encontrar erros
                if (empty($erros)){
                    $this->setCodigo($resultado->codigo);
                    $this->setDescricao($resultado->descricao);
                    $this->setAndar($resultado->andar);
                    $this->setCapacidade($resultado->capacidade);

                    $this->load->model('M_sala');
                    $resBanco = $this->M_sala->inserir(
                        $this->getCodigo(),
                        $this->getDescricao(),
                        $this->getAndar(),
                        $this->getCapacidade()
                    );

                    if ($resBanco['codigo']== 1){
                        $sucesso = true;
                    }else {
                        // captura erro do banco
                        $erros[] = ['codigo'=> $resBanco['codigo'],
                                    'msg'=> $resBanco['msg'],
                        ];
                    }                    
                }
            }            
        }catch(Exception $e){
            $erros[] = ['codigo'=> 0, 'msg' => 'Erro inesperado: ' . $e->getMessage()];
        }
        
        //MOnta retorno unico
        if ($sucesso == true){
            $retorno = ['codigo' => $sucesso, 'msg' => 'Sala cadastrada corretamente.'];
        }else{
            $retorno = ['sucesso'=> $sucesso, 'erros' => $erros];
        }

        //tranforma o array em JSON
        echo json_encode($retorno);
    }
}
?>