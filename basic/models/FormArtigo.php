<?php
namespace app\models;
use Yii;
use yii\base\model;
use app\models\Artigo;

class FormArtigo extends model {

    public $id;
    public $id_evento;
    public $id_participante;
    public $caminho;
    public $data_apresentacao;
    public $horario_apresentacao;
    public $documento_digital;
    public $nota;
    public $observacao_avaliacao;
    public $resumo;
    public $status;
    public $file;
   
    public function rules() {
        return [
            ['id','integer', 'message'=>'ID incorreto.'],
            ['id_evento','integer', 'message'=>'ID incorreto.'],
            ['id_participante','integer', 'message'=>'ID incorreto.'],
            ['resumo', 'required', 'message' => 'Campo obrigatório.'],
            ['resumo', 'ja_submeteu'],
            ['file', 'file', 
                'skipOnEmpty' => false,
                'uploadRequired' => 'Nenhum arquivo selecionado', //Error
                'maxSize' => 1024*1024*1, //1 MB
                'tooBig' => 'Tamanho máximo de 1MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'Tamanho mínimo de 10 BYTES', //Error
                'extensions' => 'pdf, doc',
                'wrongExtension' => 'O arquivo {file} não está entre os permitidos {extensions}', //Error
                'maxFiles' => 1,
                'tooMany' => 'O máximo de arquivos são {limit}', //Error
            ],
           ];
    }

    public function attributeLabels() {
        return array( 
            'data_apresentacao' => 'Data de apresentação:',
            'horario_apresentacao' => 'Hora de apresentação:',
            'observacao_avaliacao' => 'Obs.:',
            'nota' => 'Nota:',
            'resumo' => 'Resumo:',
            'status' => 'Status:',
            'file' => 'Selecione arquivo:',
            );
    }

      public function ja_submeteu($attribute, $params) {
        $table = Artigo::find()->where("id_evento=:id_evento", [":id_evento" => $this->id_evento])
                               ->andWhere("id_participante=:id_participante", [":id_participante" => $this->id_participante]);
        if ($table->count() >= 1) {
                     $this->addError($attribute, "você já submeteu artigo para este evento.");
             }
    }
    
    
}

