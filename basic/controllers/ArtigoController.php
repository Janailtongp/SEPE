<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Artigo;
use app\models\FormArtigo;
use yii\helpers\Html;
use yii\web\UploadedFile;

class ArtigoController extends Controller
{
    
      public function actionIndex(){
       $model = new FormArtigo;
        $msg = null;
        if(!isset($_GET["id_evento"]) || empty($_GET["id_evento"]) || !(int)$_GET["id_evento"]){
            $this->redirect(["usuario/index"]);
        }
        if ($model->load(Yii::$app->request->post())) {
            $idEvento = Html::encode($_GET["id_evento"]);
            $model->file = UploadedFile::getInstance($model,'file');
            $file = $model->file;
            $model->id_evento = $idEvento;
            $model->id_participante = Yii::$app->user->identity->id;
            if ($model->file && $model->validate()){
                    $file->saveAs('artigos/' ."userID_". Yii::$app->user->identity->id."_EventoID_".$idEvento. '.' . $file->extension);
                    $table = new Artigo;
                    $table->resumo = $model->resumo;
                    $table->id_participante = $model->id_participante;
                    $table->id_evento = $model->id_evento;
                    $table->status = "Em correção";
                    $table->caminho = 'artigos/' ."userID_". Yii::$app->user->identity->id."_EventoID_".$idEvento. '.' . $file->extension;
                if ($table->insert()){
                    $msg = "Dados salvos e ";
                    $model->resumo = null;
                    $model->id_participante = null;
                    $model->id_evento = null;
                } else {
                    $msg = "Erro ao cadastrar usuário :(";
                }
                    $msg .= "artigo enviado com sucesso!";
            }
        }
        return $this->render("index", ["model" => $model, "msg" => $msg]);
    }
    
}