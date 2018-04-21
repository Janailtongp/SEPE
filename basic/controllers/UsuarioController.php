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
use app\models\FormUsuarioUpload;
use app\models\FormUsuarioUploadAdmin;
use app\models\SearchUsuario;
use app\controllers\EventoController;
use app\controllers\AcontecimentoController;
use app\models\Evento;
class UsuarioController extends Controller {

    public function actionIndex() {
        $model = EventoController::Listar_meus_eventos(Yii::$app->user->identity->id);
        $model2 = EventoController::Outros_eventos(Yii::$app->user->identity->id);
        return $this->render('index', ["model" => $model,"model2"=>$model2]);
    }
    public function actionIndexacontecimento(){
        if (Yii::$app->request->get()) {
            $id = Html::encode($_GET["id"]);
            $descricao = Html::encode($_GET["descricao"]);
        }else{
            echo "Erro ao encontrar evento 3!, tente novamente ...";
            echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("usuario/index") . "'>";

        }
        if ((int) $id) {
            if (Evento::findOne($id)) {
                $model = AcontecimentoController::Listar_meus_acontecimentos(Yii::$app->user->identity->id,$id);
                $model2 = AcontecimentoController::Outros_acontecimentos(Yii::$app->user->identity->id,$id);
                return $this->render('indexacontecimento', ["model" => $model,"model2"=>$model2,"descricao"=>$descricao]);
            }
        }else{
            echo "Erro ao encontrar evento 3!, tente novamente ...";
            echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("usuario/index") . "'>";
        }
    }
     public function actionIndex2() {
            return $this->render('index2');
     }
     public function actionIndex3() {
            return $this->render('index3');
     }

    public function actionMeusdados(){
       // Exibir os dados da pessoa logada com ID -> Yii::$app->user->identity->id;
        $model = new FormUsuarioUpload;
        $msg = null;
        if (isset(Yii::$app->user->identity->id)){
                $table = Usuario::findOne(Yii::$app->user->identity->id);
                if($table){
                    $model->id = $table->id;
                    $model->username = $table->username;
                    $model->nome = $table->nome;
                    $model->cpf = $table->cpf;
                    $model->email = $table->email;
                    $model->endereco = $table->endereco;
                    $model->instituicao = $table->instituicao;
                    $model->password = $table->password;
                }else{
                     return $this->redirect(["usuario/index"]);
                }
        }else{
            return $this->redirect(["site/login"]);
        }
        //Salvar quando o Post for acionado
        if (isset(Yii::$app->user->identity->id)){
            if ($model->load(Yii::$app->request->post())){
                if ($model->validate()) {
                    $table = Usuario::findOne(Yii::$app->user->identity->id);
                    if($table){
                        $table->nome = $model->nome;
                        
                     /* [USERNAME CPF E EMAIL] NãO PODEM SER ALTERADOS POIS POSSUEM FILTRO DE EXISTÊNCIA
                        CASO O CARA DEIXE O MESMO NÃO VAI DAR ERRO.
                       $table->username = $model->username;
                        $table->email = $model->email;
                        $table->cpf = $model->cpf; */
                        
                        $table->endereco = $model->endereco;
                        $table->instituicao = $model->instituicao;
                        $table->password = $model->password;
                        if ($table->update()){
                            $msg = "Registro atualizado com sucesso!";
                        } else {
                            $msg = "Registro não pode ser atualizado";
                        }
                    } else {
                        $msg = "Registro selecionado não encontrado!";
                    }
                } else {
                    $model->getErrors();
                }
            }
        } else {
             return $this->redirect(["site/login"]);
        }
        
        return $this->render('meusdados', ["msg" => $msg, "model"=>$model]);
    }

    public function actionCadastrar() {
        $model = new FormUsuario;
        $msg = null;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $table = new Usuario;
                $table->nome = $model->nome;
                $table->email = $model->email;
                $table->password = $model->password;
                $table->endereco = $model->endereco;
                $table->instituicao = $model->instituicao;
                $table->cpf = $model->cpf;
                $table->username = $model->username;
                $table->role = 1;
                if ($table->insert()) {
                    $msg = "Usuário cadastrado com sucesso :D";
                    $model->nome = null;
                    $model->username = null;
                    $model->email = null;
                    $model->cpf = null;
                    $model->password = null;
                    $model->endereco = null;
                    $model->instituicao = null;
                    $model->confsenha  = null;
                } else {
                    $msg = "Erro ao cadastrar usuário :(";
                }
            } else {
                $model->getErrors();
            }
        }
        return $this->render("cadastrar", ["model" => $model, "msg" => $msg]);
    }

    public function actionListar() {
        $form = new SearchUsuario;
        $search = null;
        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
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
            } else {
                $form->getErrors();
            }
        } else {
            $table = Usuario::find();
            $count = clone $table;
            $pages = new Pagination([
                "pageSize" => 1,
                "totalCount" => $count->count(),
            ]);
            $model = $table
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        }
        return $this->render("listar", ["model" => $model, "form" => $form, "search" => $search, "pages" => $pages]);
    }

    public function actionDelete() {
        if (Yii::$app->request->post()) {
            $id_usuario = Html::encode($_POST["id_usuario"]);
            if ((int) $id_usuario) {
                if (Usuario::deleteAll("id=:id_usuario", [":id_usuario" => $id_usuario])) {
                    echo "Usuário excluido com sucesso! ...";
                    echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("usuario/listar") . "'>";
                } else {
                    echo "Erro ao excluir Usuário, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("usuario/listar") . "'>";
                }
            } else {
                echo "Erro ao excluir Usuário, tente novamente ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("usuario/listar") . "'>";
            }
        } else {
            return $this->redirect(["usuario/listar"]);
        }
    }
    
  public function actionEditar(){
        $model = new FormUsuarioUploadAdmin;
        $msg = null;
        //Exibir os dados pegando do GET
         if(Yii::$app->request->get("id_usuario")){
            $id_usuario = Html::encode($_GET['id_usuario']);
            if((int) $id_usuario){
                $table = Usuario::findOne($id_usuario);
                if($table){
                    $model->id = $table->id;
                    $model->username = $table->username;
                    $model->nome = $table->nome;
                    $model->cpf = $table->cpf;
                    $model->email = $table->email;
                    $model->endereco = $table->endereco;
                    $model->instituicao = $table->instituicao;
                    $model->role = $table->role;
                }else{
                     return $this->redirect(["usuario/listar"]);
                }
            }  else {
                return $this->redirect(["usuario/listar"]);
            }
        }else{
            return $this->redirect(["usuario/listar"]);
        }
        // Fazer a alteração dos dados 
        
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $table = Usuario::findOne($model->id);
                if($table){
                    $table->username = $model->username;
                    $table->nome = $model->nome; 
                    $table->cpf = $model->cpf;
                    $table->email = $model->email;
                    $table->endereco = $model->endereco;
                    $table->instituicao = $model->instituicao;
                    $table->role = $model->role;
                    if($table->update()){
                        $msg = "Registro atualizado com sucesso!";
                    } else {
                        $msg = "Registro não pode ser atualizado 1"; //aqui
                    }
                }else{
                    $msg = "Registro selecionado não encontrado! 2";
                }
            }else{
                $model->getErrors();
            }
        }
        return $this->render("editar",["msg"=>$msg, "model"=>$model]);
    }
    
    
    
    public function behaviors(){
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['listar','excluir', "meusdados","editar","index","index2","index3"],
                'rules' => [
                    [
                        'actions' =>['listar','excluir', "meusdados","editar","index3"],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' =>function($rule, $action){
                        return User::isUserAdmin(Yii::$app->user->identity->id); 
                        },
                    ],
                    [
                        'actions' =>['listar',"meusdados","editar","index2"],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' =>function($rule, $action){
                        return User::isUserChefe(Yii::$app->user->identity->id); 
                        },  
                    ],
                    [
                        'actions' =>["meusdados","index",],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' =>function($rule, $action){
                        return User::isUserSimple(Yii::$app->user->identity->id); 
                        },  
                    ],            
                ],                
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
   }
    
    
}
