<?php
namespace app\models;
use Yii;
use yii\base\model;

class FormAcontecimento extends model {

    public $id;
    public $id_usuario;
    public $id_evento;
    public $descricao;
    public $tipo;
    public $local_acontecimento;
    public $data_inicio;
    public $data_fim;
    public $status;
    public $ministrante;
  
    public function rules() {
        return [
            ['id','integer', 'message'=>'ID incorreto.'],
            ['id_usuario','integer', 'required', 'message' => 'Campo obrigatório.'],
            ['id_evento','integer', 'required', 'message' => 'Campo obrigatório.'],
            ['ministrante','required'],
            ['descricao', 'match', 'pattern' => "/^.{3,200}$/", 'message' => 'Tamanho entre 3 e 200 caracteres.'],
            ['descricao', 'match', 'pattern' => "/^[a-záéíóúñâêôûãõ ]+$/i", 'message' => 'Apenas letras.'],
            ['local_acontecimento', 'required', 'message' => 'Campo obrigatório.'],
            ['local_acontecimento', 'match', 'pattern' => "/^.{3,200}$/", 'message' => 'Tamanho entre 3 e 200 caracteres.'],
            ['local_acontecimento', 'match', 'pattern' => "/^[1-9a-záéíóúñâêôûãõ -°]+$/i", 'message' => 'Apenas letras e números.'],
            ['data_inicio', 'required', 'message' => 'Campo obrigatório.'],
            ['data_fim', 'required', 'message' => 'Campo obrigatório.'],
            ['status','required'],
            ['tipo','required']
            
             ];
    }

    public function attributeLabels() {
        return array( 
            'descricao' => 'Descrição do Acontecimento:',
            'local_acontecimento' => 'Local Acontecimento:',
            'data_inicio' => 'Data do Inicio do Acontecimento',
            'tipo'=>'Tipo: ',
            'status'=>'Status:',
            'id_usuario'=>'Usuário:',
            'ministrante'=>'Ministrante(s)',
            'data_fim' => 'Data do Fim do Acontecimento:'
            );
    }

    
    
    
}

