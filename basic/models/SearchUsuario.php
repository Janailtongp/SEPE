<?php
namespace app\models;
use Yii;
use yii\base\model;

class SearchUsuario extends model{
    public $q;
    
    public function rules(){
        return[
            ["q", "match", "pattern"=>"/^[0-9a-záéíóúñãõâêiôû@ \s]+$/i", "message"=> "Apenas letras e números serão aceitos"]
        ];
    }
    
    public function attributeLabels() {
        return array(
            'q' => 'Pesquisar:',
        );
    }
}