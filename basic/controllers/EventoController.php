<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\SearchEvento;
use app\models\Inscricao_Evento;

use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;
use app\models\Evento;
use app\models\User;
use app\models\FormEvento;




class EventoController extends Controller {
     public function actionIndex() {
        $form = new SearchEvento;
        $search = null;
        if($form->load(Yii::$app->request->get())){
            if($form->validate()){
                $search = Html::encode($form->q);
                $table = Evento::find()->where(["like", "id", $search])
                                       ->orWhere(["like", "descricao", $search])
                                       ->orWhere(["like", "data_inicio", $search])
                                       ->orWhere(["like", "data_fim", $search])
                        ->orWhere(["like", "local_evento", $search]);
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
            $table = Evento::find();
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
        $cadastroModel= new FormEvento();
        $msg = null;

        $post=Yii::$app->request->post();
        if($cadastroModel->load($post) && $cadastroModel->validate()){
            $evento=  new Evento;
            $evento->descricao=$cadastroModel->descricao;
            $evento->local_evento=$cadastroModel->local_evento;
            $evento->data_inicio=$cadastroModel->data_inicio;
            $evento->data_fim=$cadastroModel->data_fim;
                  if($evento->insert()){
                    $msg =  "Evento cadastrado com sucesso :D";
                    $cadastroModel->descricao = null;
                    $cadastroModel->local_evento = null;
                    $cadastroModel->data_inicio = null;
                    $cadastroModel->data_fim = null;
                    
                }else{
                    $msg = "Erro ao cadastrar evento :(";
                }

        }
        return $this->render("cadastrar",["model"=>$cadastroModel, "msg"=>$msg]);

    }
    public function actionInscrever() {
        if(Yii::$app->request->post()){
            $id = Html::encode($_POST["id"]);
                if((int) $id){

                   $inscricao=  new Inscricao_Evento();
                   $inscricao->id_evento=$id;
                   $inscricao->id_participante=Yii::$app->user->identity->id;
                   $inscricao->status="Aprovada";
                      if($inscricao->insert()){
                        echo "Sua inscrição foi realizada com sucesso!";
                      echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("evento/index")."'>";
                          
                      }
                      }

                }else{
                    echo "Error ao se inscrever, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("evento/index")."'>";
                }
    
    }
    public function actionDelete() {
        if(Yii::$app->request->post()){
            $id = Html::encode($_POST["id"]);
                if((int) $id){
                    if(Evento::deleteAll("id=:id",[":id" => $id])){
                        echo "Registro excluido com sucesso! ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("evento/index")."'>";
                    }else{
                        echo "Erro ao excluir Registro, tente novamente ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("evento/index")."'>";
                    }
                }else{
                    echo "Erro ao excluir Registro, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("evento/index")."'>";
                }
        }else{
            return $this->redirect(["evento/index"]);
        }
    }
    public function actionEditar() {
        $model = new FormEvento;
        $msg = null;
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $table = Evento::findOne($model->id);
                if($table){
                    $table->descricao = $model->descricao;
                    $table->local_evento = $model->local_evento;
                    $table->data_inicio = $model->data_inicio;
                    $table->data_fim = $model->data_fim;
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
                $table = Evento::findOne($id);
                if($table){
                    $model->id = $table->id;
                    $model->descricao = $table->descricao;
                    $model->local_evento = $table->local_evento;
                    $model->data_inicio = $table->data_inicio;
                    $model->data_fim = $table->data_fim;

                }else{
                     return $this->redirect(["evento/index"]);
                }
            }  else {
                return $this->redirect(["evento/index"]);
            }
        }else{
            return $this->redirect(["evento/index"]);
        }
        return $this->render("editar",["msg"=>$msg, "model"=>$model]);
    }
    public function actionInscricoes() {
        $form = new SearchEvento;
        $search = null;
        $inscricoes=  Inscricao_Evento::find()->where(array("id_participante"=>Yii::$app->user->identity->id));
      
        if($form->load(Yii::$app->request->get())){
            if($form->validate()){
                $search = Html::encode($form->q);
                $table = Evento::find()->where(["like", "id", $search])
                                       ->orWhere(["like", "descricao", $search])
                                       ->orWhere(["like", "data_inicio", $search])
                                       ->orWhere(["like", "data_fim", $search])
                        ->orWhere(["like", "local_evento", $search]);
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
            $table = Evento::find();
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
        
        return $this->render("inscricoes",["model"=>$model, "form"=>$form, "search"=>$search, "pages"=>$pages,"t"=>$inscricoes]);
        }
   }
   
   
    
   
    
