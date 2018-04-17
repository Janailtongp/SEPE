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




class UsuarioController extends Controller {
     public function actionIndex() {
        return $this->render('index');
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
    
   
    
}