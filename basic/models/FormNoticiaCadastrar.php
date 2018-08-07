<?php
namespace app\models;
use Yii;
use yii\base\model;
use app\models\Noticia;

class FormNoticiaCadastrar extends model {

    public $id;
    public $titulo;
    public $corpo;
    public $data_noticia;
    public $autor;
    
    public function rules() {
        return [
            ['id','integer', 'message'=>'ID incorreto.'],
            ['titulo', 'required', 'message' => 'Campo obrigatório.'],
            ['corpo', 'required', 'message' => 'Campo obrigatório.'],
           ];
    }

    public function attributeLabels() {
        return array( 
            'corpo' => 'Conteúdo da matéria:',
            'titulo' => 'Título:'
            );
    }

}

