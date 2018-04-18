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
            ['descricao', 'match', 'pattern' => "/^.{3,200}$/", 'message' => 'Tamanho entre 3 e 200 caracteres.'],
            ['descricao', 'match', 'pattern' => "/^[a-záéíóúñâêôûãõ ]+$/i", 'message' => 'Apenas letras.'],
            ['local_acontecimento', 'required', 'message' => 'Campo obrigatório.'],
            ['local_acontecimento', 'match', 'pattern' => "/^.{3,200}$/", 'message' => 'Tamanho entre 3 e 200 caracteres.'],
            ['local_acontecimento', 'match', 'pattern' => "/^[1-9a-záéíóúñâêôûãõ -°]+$/i", 'message' => 'Apenas letras e números.'],
            ['data_inicio', 'required', 'message' => 'Campo obrigatório.'],
            ['data_fim', 'required', 'message' => 'Campo obrigatório.'],
            ['status','required', 'message' => 'Campo obrigatório.'],
            ['tipo','required', 'message' => 'Campo obrigatório.'],
            ['id_evento', 'required', 'message' => 'Campo obrigatório.'],
            ['ministrante','required', 'message' => 'Campo obrigatório.'],
            ['ministrante', 'match', 'pattern' => "/^[a-záéíóúñâêôûãõ ]+$/i", 'message' => 'Apenas letras.'],
            ];
    }

    public function attributeLabels() {
        return array( 
            'descricao' => 'Descrição do Acontecimento:',
            'local_acontecimento' => 'Local Acontecimento:',
            'data_inicio' => 'Data do Inicio do Acontecimento',
            'tipo'=>'Tipo:',
            'status'=>'Status:',
            'id_usuario'=>'ID do Usuário:',
            'id_evento'=>'ID do Evento:',
            'ministrante'=>'Ministrante(s)',
            'data_fim' => 'Data do Fim do Acontecimento:',
            );
    }

    
    
    
}

