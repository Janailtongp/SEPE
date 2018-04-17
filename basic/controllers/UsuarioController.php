<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FormSearch;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;
use app\models\Usuario;
use app\models\User;
use app\models\FormUsuario;
use app\models\SearchUsuario;




class UsuarioController extends Controller {
     public function actionIndex() {
         $idLogado = Yii::$app->user->identity->id;
        return $this->render('index',["idLogado"=>$idLogado]);
    }
    public function actionCadastrar() {
        $model = new FormUsuario;
        $msg = null;
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $table = new Usuario;
                $table->nome = $model->nome;
                $table->email = $model->email;
                $table->password = $model->password;
                $table->endereco = $model->endereco;
                $table->instituicao = $model->instituicao;
                $table->cpf = $model->cpf;
                $table->username = $model->username;
                $table->role = 1;
                if($table->insert()){
                    $msg =  "Usuário cadastrado com sucesso :D";
                    $model->nome = null;
                    $model->username = null;
                    $model->email = null;
                    $model->cpf = null;
                    $model->password = null;
                    $model->endereco = null;
                    $model->instituicao = null;
                }else{
                    $msg = "Erro ao cadastrar usuário :(";
                }
            }else{
                $model->getErrors();
            }
        }
        return $this->render("cadastrar",["model"=>$model, "msg"=>$msg]);
    }
    
     public function actionListar(){
        $form = new SearchUsuario;
        $search = null;
        if($form->load(Yii::$app->request->get())){
            if($form->validate()){
                $search = Html::encode($form->q);
                $table = Usuario::find()->where(["like", "id", $search])
                                       ->orWhere(["like", "nome", $search])
                                       ->orWhere(["like", "username", $search])
                                       ->orWhere(["like", "email", $search])
                                       ->orWhere(["like", "cpf", $search])
                                       ->orWhere(["like", "instituicao", $search]);
                $count = clone $table;
                $pages = new Pagination([
                    "pageSize" => 1,
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
            $table = Usuario::find();
            $count = clone $table;
            $pages =  new Pagination([
                "pageSize" => 1,
                "totalCount" => $count->count(),
            ]);
            $model = $table
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        }
        return $this->render("listar",["model"=>$model, "form"=>$form, "search"=>$search, "pages"=>$pages]);
    }
   
    public function actionDelete(){
        if(Yii::$app->request->post()){
            $id_usuario = Html::encode($_POST["id_usuario"]);
                if((int) $id_usuario){
                    if(Usuario::deleteAll("id=:id_usuario",[":id_usuario" => $id_usuario])){
                        echo "Usuário excluido com sucesso! ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("usuario/listar")."'>";
                    }else{
                        echo "Erro ao excluir Usuário, tente novamente ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("usuario/listar")."'>";
                    }
                }else{
                    echo "Erro ao excluir Usuário, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("usuario/listar")."'>";
                }
        }else{
            return $this->redirect(["usuario/listar"]);
        }
    }
    
}