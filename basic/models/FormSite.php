<?php
namespace app\models;
use Yii;
use yii\base\model;
use app\models\Site;

class FormSite extends model {

    public $id;
    public $descricao;
    public $imagem;
    public $titulo;
    
    public function rules() {
        return [
            ['id','integer', 'message'=>'ID incorreto.'],
            ['titulo', 'required', 'message' => 'Campo obrigatório.'],
            ['descricao', 'required', 'message' => 'Campo obrigatório.'],
            ['imagem', 'file', 
                'skipOnEmpty' => true,
               // 'uploadRequired' => 'Nenhum arquivo selecionado', //Error
                'maxSize' => 1024*1024*5, //1 MB
                'tooBig' => 'Tamanho máximo de 2MB', //Error
                //'minSize' => 10, //10 Bytes
                //'tooSmall' => 'Tamanho mínimo de 10 BYTES', //Error
                'extensions' => 'png, jpg',
                'wrongExtension' => 'O arquivo {file} não está entre os permitidos {extensions}', //Error
                'maxFiles' => 1,
                'tooMany' => 'O máximo de arquivos são {limit}', //Error
            ],
           ];
    }

    public function attributeLabels() {
        return array( 
            'descricao' => 'Descrição:',
            'titulo' => 'Título:',
            'imagem' => 'Imagem [LOGO] do site:'
            );
    }

}

