<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\SearchPropostas;

use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;
use app\models\Propostas;
use app\models\User;
use app\models\FormPropostas;




class PropostasController extends Controller {
     public function actionIndex() {
        $form = new SearchPropostas();
        $search = null;
        if($form->load(Yii::$app->request->get())){
            if($form->validate()){
                $search = Html::encode($form->q);
                $table = Propostas::find()->where(["like", "id", $search])
                                       ->orWhere(["like", "descricao", $search])
                                       ->orWhere(["like", "tipo", $search])
                                       ->orWhere(["like", "status", $search]);
                $count = clone $table;
                $pages = new Pagination([
                    "pageSize" => 4,
                    "totalCount" => $count->count(),
                ]);
                $model = $table
                        ->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
            }else{
                $form->getErrors();
            }
        }else{
            $table = Propostas::find();
            $count = clone $table;
            $pages =  new Pagination([
                "pageSize" => 4,
                "totalCount" => $count->count(),
            ]);
            $model = $table
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        }
        return $this->render("index",["model"=>$model, "form"=>$form, "search"=>$search, "pages"=>$pages]);
        }
        public function actionCadastrar(){
          /*
            passagem de parametro
          */
        //instanciando model do formulario com as regras
        $cadastroModel= new FormPropostas();
        $msg = null;

        $post=Yii::$app->request->post();
        if($cadastroModel->load($post) && $cadastroModel->validate()){
            $propostas=  new Propostas;
          $propostas->descricao=$cadastroModel->descricao;
            $propostas->tipo=$cadastroModel->tipo;
            $propostas->status=$cadastroModel->status;
            $propostas->id_participante=Yii::$app->user->identity->id;
                  if($propostas->insert()){
                    $msg =  "Proposta cadastrada com sucesso :D";
                    $cadastroModel->descricao = null;
                    $cadastroModel->tipo= null;
                    $cadastroModel->status = null;
                    
                }else{
                    $msg = "Erro ao cadastrar evento :(";
                }

        }
        return $this->render("cadastrar",["model"=>$cadastroModel, "msg"=>$msg]);

    }
    public function actionDelete() {
        if(Yii::$app->request->post()){
            $id = Html::encode($_POST["id"]);
                if((int) $id){
                    if(Propostas::deleteAll("id=:id",[":id" => $id])){
                        echo "Registro excluido com sucesso! ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("propostas/index")."'>";
                    }else{
                        echo "Erro ao excluir Registro, tente novamente ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("propostas/index")."'>";
                    }
                }else{
                    echo "Erro ao excluir Registro, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("propostas/index")."'>";
                }
        }else{
            return $this->redirect(["propostas/index"]);
        }
    }
    public function actionEditar() {
        $model = new FormPropostas();
        $msg = null;
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $table = Propostas::findOne($model->id);
                if($table){
                    $table->descricao = $model->descricao;
                    $table->tipo = $model->tipo;
                    $table->status = $model->status;
                    if($table->update()){
                        $msg = "Registro atualizado com sucesso!";
                    }  else {
                        $msg = "Registro não pode ser atualizado";
                    }
                }else{
                    $msg = "Registro selecionado não encontrado!";
                }
            }else{
                $model->getErrors();
            }
        }
        
        if(Yii::$app->request->get("id")){
            $id = Html::encode($_GET['id']);
            if((int) $id){
                $table = Propostas::findOne($id);
                if($table){
                    $model->id = $table->id;
                    $model->descricao = $table->descricao;
                    $model->tipo = $table->tipo;
                    $model->status = $table->status;

                }else{
                     return $this->redirect(["propostas/index"]);
                }
            }  else {
                return $this->redirect(["propostas/index"]);
            }
        }else{
            return $this->redirect(["propostas/index"]);
        }
        return $this->render("editar",["msg"=>$msg, "model"=>$model]);
    }
   }
   
   
    
   
    
