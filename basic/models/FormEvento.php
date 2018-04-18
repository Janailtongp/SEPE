<?php
namespace app\models;
use Yii;
use yii\base\model;

class FormEvento extends model {

    public $id;
    public $local_evento;
    public $descricao;
    public $data_inicio;
    public $data_fim;
   
    public function rules() {
        return [
            ['id','integer', 'message'=>'ID incorreto.'],
            ['descricao', 'required', 'message' => 'Campo obrigatório.'],
            ['descricao', 'match', 'pattern' => "/^.{3,200}$/", 'message' => 'Tamanho entre 3 e 200 caracteres.'],
            ['descricao', 'match', 'pattern' => "/^[a-záéíóúñâêôûãõ ]+$/i", 'message' => 'Apenas letras.'],
            ['local_evento', 'required', 'message' => 'Campo obrigatório.'],
            ['local_evento', 'match', 'pattern' => "/^.{3,200}$/", 'message' => 'Tamanho entre 3 e 200 caracteres.'],
            ['local_evento', 'match', 'pattern' => "/^[1-9a-záéíóúñâêôûãõ -°]+$/i", 'message' => 'Apenas letras e números.'],
            ['data_inicio', 'required', 'message' => 'Campo obrigatório.'],
            ['data_fim', 'required', 'message' => 'Campo obrigatório.']
            
             ];
    }

    public function attributeLabels() {
        return array( 
            'descricao' => 'Descrição do Evento:',
            'local_evento' => 'Local Evento:',
            'data_inicio' => 'Data do Inicio do Evento',
            'data_fim' => 'Data do Fim do Evento'
            );
    }

    
    
    
}

