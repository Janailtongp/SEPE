<?php
namespace app\models;
use Yii;
use yii\base\model;
use app\models\Artigo;

class FormArtigoAvaliar extends model {

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
            ['data_apresentacao','string', 'message'=>'Data incorreto.'],
            ['horario_apresentacao','string', 'message'=>'Hora incorreto.'],
            ['nota', 'match', 'pattern' => "/^[01-9,]+$/i", 'message' => 'Apanas números e (,).'],
            ['observacao_avaliacao', 'match', 'pattern' => "/^.{0,250}$/", 'message' => 'Tamanho máximo de 250 caracteres.'],
            ['observacao_avaliacao', 'match', 'pattern' => "/^[.,-a-záéíóúñâêôûãõçúà ]+$/i", 'message' => 'Apenas letras.'],
            ['status', 'required', 'message' => 'Campo obrigatório.'],
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

}

