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
use app\models\Usuario;

use app\models\User;
use app\models\FormPropostas;




class PropostasController extends Controller {
    public function Minhas_Propostas($id){
          $sql = (new \yii\db\Query())->select('p.descricao descricao,p.tipo tipo,p.status status,p.id id,p.area_conhecimento area_conhecimento')->from('propostas p')
                        ->where('p.id_participante=:id', array(':id'=>$id))->all();
                return $sql;
    }
     public function actionIndex() {
        $form = new SearchPropostas();
        $usuarios = (new \yii\db\Query())->select('u.nome usuario,u.id id')->from('usuario u')->all();
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
        return $this->render("index",["model"=>$model, "form"=>$form, "search"=>$search, "pages"=>$pages,"usuarios"=>$usuarios]);
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
            $propostas->area_conhecimento=$cadastroModel->area_conhecimento;

            $propostas->id_participante=Yii::$app->user->identity->id;
                  if($propostas->insert()){
                    $msg =  "Proposta cadastrada com sucesso :D";
                    $cadastroModel->descricao = null;
                    $cadastroModel->tipo= null;
                    
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
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("usuario/index")."'>";
                    }else{
                        echo "Erro ao excluir Registro, tente novamente ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("usuario/index")."'>";
                    }
                }else{
                    echo "Erro ao excluir Registro, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("usuario/index")."'>";
                }
        }else{
            return $this->redirect(["propostas/index"]);
        }
    }
    public function actionAprovar(){
        if(Yii::$app->request->post()){
            $id = Html::encode($_POST["id"]);
                if((int) $id){
                     $table = Propostas::findOne($id);
                    if($table){
                    $table->status ="Aprovada!";
                    if($table->update()){
                        echo "Proposta Aprovada!";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("propostas/index")."'>";                    }  else {
                    }
                }else{
                    echo "Erro ao aprovar proposta, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("propostas/index")."'>";
                }
        }else{
            return $this->redirect(["propostas/index"]);
        } 
       }
    }
     public function actionDesaprovar(){
        if(Yii::$app->request->post()){
            $id = Html::encode($_POST["id"]);
                if((int) $id){
                     $table = Propostas::findOne($id);
                    if($table){
                    $table->status ="Não Aprovada!";
                    if($table->update()){
                        echo "Proposta Não Aprovada!";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("propostas/index")."'>";                    }  else {
                    }
                }else{
                    echo "Erro ao desaprovar proposta, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("propostas/index")."'>";
                }
        }else{
            return $this->redirect(["propostas/index"]);
        } 
       }
    }
    public function actionEditar() {
        $model = new FormPropostas();
        $msg = null;
        
        if(Yii::$app->request->get("id")){
            $id = Html::encode($_GET['id']);
            if((int) $id){
                $table = Propostas::findOne($id);
                if($table){
                    $model->id = $table->id;
                    $model->descricao = $table->descricao;
                    $model->tipo = $table->tipo;

                }else{
                     return $this->redirect(["propostas/index"]);
                }
            }  else {
                return $this->redirect(["propostas/index"]);
            }
        }else{
            return $this->redirect(["propostas/index"]);
        }
        
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $table = Propostas::findOne($model->id);
                if($table){
                    $table->descricao = $model->descricao;
                    $table->tipo = $model->tipo;
                                      $table->area_conhecimento = $model->area_conhecimento;
  
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
        return $this->render("editar",["msg"=>$msg, "model"=>$model]);
    }
   }
   
   
    
   
    
