<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;

use app\models\SearchEvento;
use app\models\SearchAcontecimento;


use app\models\Evento;
use app\models\User;
use app\models\Acontecimento;

use app\models\FormEvento;
use app\models\FormAcontecimento;




class AcontecimentoController extends Controller {
     public function actionIndex($id='') {
        $form = new SearchAcontecimento();
        $search = null;
        if((int) $id){
            if(Evento::findOne($id)){
                       // listando acontecimento
                 
       
        if($form->load(Yii::$app->request->get())){
            if($form->validate()){
                $search = Html::encode($form->q);
                $table = Acontecimento::find()->where(["like", "id", $search])
                                       ->orWhere(["like", "id_usuario", $search])
                                       ->orWhere(["like", "descricao", $search])
                                       ->orWhere(["like", "tipo", $search])
                                        ->orWhere(["like", "ministrante", $search])
                                       ->orWhere(["like", "local_acontecimento", $search])
                                       ->orWhere(["like", "data_inicio", $search])
                                       ->orWhere(["like", "data_fim", $search])

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

            $table = Acontecimento::find()->where(array('id_evento'=>$id));
            

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

                    }else{
                        echo "Erro, tente novamente ... 3";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("evento/index")."'>";
                    }
                }else{
                    echo "Erro ao encontrar evento 3!, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("evento/index")."'>";
                }
        
        }
        public function actionCadastrar(){
          /*
            passagem de parametro
          */
        //instanciando model do formulario com as regras
        $cadastroModel= new FormAcontecimento();
        $msg = null;

        $post=Yii::$app->request->post();
        if($cadastroModel->load($post) && $cadastroModel->validate()){
           $acontecimento=  new Acontecimento;
           $acontecimento->descricao=$cadastroModel->descricao;
           $acontecimento->local_acontecimento=$cadastroModel->local_acontecimento;
           $acontecimento->data_inicio=$cadastroModel->data_inicio;
           $acontecimento->data_fim=$cadastroModel->data_fim;
           $acontecimento->tipo=$cadastroModel->tipo;
           $acontecimento->id_usuario=$cadastroModel->id_usuario;
           $acontecimento->tipo=$cadastroModel->tipo;
           $acontecimento->id_evento=$cadastroModel->id_evento;

            
            
                  if($evento->insert()){
                    $msg =  "Acontecimento cadastrado com sucesso :D";
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
   }
   
   
    
   
    
