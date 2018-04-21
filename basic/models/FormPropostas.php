<?php
namespace app\models;
use Yii;
use yii\base\model;

class FormPropostas extends model {

    public $id;
    public $id_participante;
    public $descricao;
    public $tipo;
    
  
    public function rules() {
        return [
            ['descricao', 'match', 'pattern' => "/^.{3,200}$/", 'message' => 'Tamanho entre 3 e 200 caracteres.'],
            ['descricao', 'match', 'pattern' => "/^[a-záéíóúñâêôûãõ ]+$/i", 'message' => 'Apenas letras.'],
           
            ['tipo','required', 'message' => 'Campo obrigatório.']
            ];
    }

    public function attributeLabels() {
        return array( 
            'descricao' => 'Descrição do Acontecimento:',
           
            'tipo'=>'Tipo:',
            
            );
    }

    
    
    
}

