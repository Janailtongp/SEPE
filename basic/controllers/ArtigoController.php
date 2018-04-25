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
use app\models\Evento;
use app\models\Usuario;
use app\models\Artigo;
use app\models\FormArtigoAvaliar;
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
                    $table->area_conhecimento=$model->area_conhecimento;
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
    
    public function Meus_artigos($idUsuario, $idevento) {
        $sql = (new \yii\db\Query())->select('*')->from('artigo')
                        ->where('id_evento=:id_evento', array(':id_evento'=>$idevento))
                        ->andWhere('id_participante=:id_uso', array(':id_uso'=>$idUsuario))->all();
                return $sql;
    }
    
    public function actionListar(){
        $model = null;
        $titulo = null;
         if (Yii::$app->request->get("id_evento") && Yii::$app->request->get("titulo")) {
            $id = Html::encode($_GET["id_evento"]);
            $titulo = Html::encode($_GET["titulo"]);
            if ((int)$id && isset($titulo)){
                if (Evento::findOne($id)){
                    $model = (new \yii\db\Query())->select('*')->from('artigo')
                             ->where("id_evento=:id",array(':id'=>$id))
                             ->all();
                }
            }else{
                $this->redirect(["evento/index"]);
            }
             
         }else{
             $this->redirect(["evento/index"]);
         }
         return $this->render("listar", ["model" => $model,"titulo"=>$titulo]);
    }
    public function actionAvaliar(){
        $model = new FormArtigoAvaliar;
        $model2 = new Usuario;
        $msg = null;
        $table2 = null;
        //Exibir os dados pegando do GET
         if(Yii::$app->request->get("id")){
            $id = Html::encode($_GET['id']);
            if((int) $id){
                $table = Artigo::findOne($id);
                if($table){
                    $model->id = $table->id;
                    $model->id_participante = $table->id_participante;
                    $model->data_apresentacao = $table->data_apresentacao;
                    $model->horario_apresentacao = $table->horario_apresentacao;
                    $model->nota = $table->nota;
                    $model->observacao_avaliacao = $table->observacao_avaliacao;
                    $model->status = $table->status;
                    //Pegar dados do usuário dono do artigo
                    $table2 = Usuario::findOne($table->id_participante);
                    $model2 = $table2;
                }else{
                     return $this->redirect(["evento/index"]);
                }
            }  else {
                return $this->redirect(["evento/index"]);
            }
        }else{
            return $this->redirect(["evento/index"]);
        }
        // Fazer a alteração dos dados 
        
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $table = Artigo::findOne($model->id);
                if($table){
                    $table->data_apresentacao = $model->data_apresentacao;
                    $table->horario_apresentacao = $model->horario_apresentacao;
                    $table->nota = $model->nota;
                    $table->observacao_avaliacao = $model->observacao_avaliacao;
                    $table->status = $model->status;
                    if($table->update()){
                        $msg = "Correção realizada com com sucesso!";
                    } else {
                        $msg = "Correção não pode ser realizada!"; 
                    }
                }else{
                    $$msg = "Correção não pode ser realizada!";
                }
            }else{
                $model->getErrors();
            }
        }
        return $this->render("avaliar",["msg"=>$msg, "model"=>$model, "model2"=>$model2]);
    }
    
}