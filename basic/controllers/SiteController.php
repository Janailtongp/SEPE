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
use app\models\FormSite;
use app\models\Site;
use app\models\Noticia;
use app\models\FormNoticiaCadastrar;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\helpers\Url;
use app\models\SearchNoticia;
use yii\data\Pagination;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','painel','cadastrarnoticia','listarnoticias','editarnoticia','deletarnoticia'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' =>['painel','cadastrarnoticia','listarnoticias','editarnoticia','deletarnoticia'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' =>function($rule, $action){
                        return User::isUserAdmin(Yii::$app->user->identity->id); 
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {   
        $sql = (new \yii\db\Query())->select('*')->from('site')->all();
        return $this->render('index',["sql" => $sql]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            if(User::isUserAdmin(Yii::$app->user->identity->id)){
                return $this->redirect(["usuario/index3"]);
            }else if(User::isUserChefe(Yii::$app->user->identity->id)){
                return $this->redirect(["usuario/index2"]);
            }else{
                 return $this->redirect(["usuario/index"]);
            }
           // return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(User::isUserAdmin(Yii::$app->user->identity->id)){
                return $this->redirect(["usuario/index3"]);
            }else if(User::isUserChefe(Yii::$app->user->identity->id)){
                return $this->redirect(["usuario/index2"]);
            }else{
                 return $this->redirect(["usuario/index"]);
            }
           // return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }
    
    
    
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
     
     public function actionPainel()
    {
       $model = new FormSite;
       $msg = null;
       $link = null;
       $sql = (new \yii\db\Query())->select('*')->from('site')->all();
       if(count($sql) == 0){
            if ($model->load(Yii::$app->request->post())) {
                $model->imagem = UploadedFile::getInstance($model,'imagem');
                $file = $model->imagem;
                if ($model->validate()){
                        if(!empty($model->imagem)){
                            $file->saveAs('imagens/' ."capa". '.' . $file->extension);
                            $table->imagem = 'imagens/' ."capa". '.' . $file->extension; 
                            $msg = "+ Imagem salva com sucesso.";
                        }else{
                            $msg = "+ O site ainda não possui imagens.";
                        }
                        $table = new Site;
                        $table->descricao = $model->descricao;
                        $table->titulo = $model->titulo;
                                          
                    if ($table->insert()){
                        $msg = "<br/>+ Dados cadastrados.";
                        $model->descricao = null;
                        $model->titulo = null;
                        $model->imagem = null;
                        echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("site/painel") . "'>";
                    } else {
                        $msg = "<br/> +Erro ao cadastrar dados do site :(";
                    }
                        $msg .= "<br/> +Site Cadastrado com sucesso!";
                }

            }
       }else if(count($sql) == 1){
           $table = Site::findOne(1);
                if($table){
                    $model->descricao = $table->descricao;
                    $model->titulo = $table->titulo;
                    $link = $table->imagem;                   
                }                
             if ($model->load(Yii::$app->request->post())) {
                $model->imagem = UploadedFile::getInstance($model,'imagem');
                $file = $model->imagem;
                   if ($model->validate()){
                       if(!empty($model->imagem)){
                            $file->saveAs('imagens/' ."capa". '.' . $file->extension);
                            $table->imagem = 'imagens/' ."capa". '.' . $file->extension;
                            $msg = "+ Imagem atualizada.";
                       }else{
                           $msg = "+ A imagem atual foi mantida.";
                       }
                        $table->descricao = $model->descricao;
                        $table->titulo = $model->titulo;
                    if ($table->update()){
                        $msg .= "<br/>+ Dados atualizados.";
                        $model->descricao = null;
                        $model->titulo = null;
                        $model->imagem = null;
                        echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("site/painel") . "'>";
                    } else {
                        $msg .= "<br/>+ Título e descrição não divergem do anterior.";
                        echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("site/painel") . "'>";
                    }
                }
                    }else{
                        $model->getErrors();
                    }
        }
        return $this->render("painel", ["model" => $model, "msg" => $msg, "link"=>$link]);
    }
    
    public function actionCadastrarnoticia(){
        $model = new FormNoticiaCadastrar;
        $msg =null;
          if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()){
                        $table = new Noticia;
                        $table->titulo = $model->titulo;
                        $table->corpo = $model->corpo;
                        $table->data_noticia = date('d/m/Y', time());
                        $sql = (new \yii\db\Query())->select('*')->from('usuario')->where('id =:idUSER', array(':idUSER'=>Yii::$app->user->identity->id))->all();
                        $table->autor = $sql[0]['nome'];
                                          
                    if ($table->insert()){
                        $msg = "<br/>+ Notícia cadastrada.";
                        $model->corpo = null;
                        $model->titulo = null;
                        echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("site/cadastrarnoticia") . "'>";
                    } else {
                        $msg = "<br/> +Erro ao cadastrar notícia no site :(";
                    }
                        $msg .= "<br/> +Notícia publicada com sucesso!";
                }

            }
        return $this->render("novaNoticia", ["model" => $model, "msg" => $msg]);
    }
    
    public function actionListarnoticias(){
        $form = new SearchNoticia;
        $search = null;
        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
                $search = Html::encode($form->q);
                $table = Noticia::find()->where(["like", "id", $search])
                        ->orWhere(["like", "titulo", $search])
                        ->orWhere(["like", "corpo", $search])
                        ->orWhere(["like", "autor", $search])->orderBy([
                    'data_noticia' => SORT_DESC
                     ]);
                $count = clone $table;
                $pages = new Pagination([
                    "pageSize" => 10,
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
            $table = Noticia::find()->orderBy([
                    'data_noticia' => SORT_DESC
                     ]);
            $count = clone $table;
            $pages = new Pagination([
                "pageSize" => 10,
                "totalCount" => $count->count(),
            ]);
            $model = $table
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        }
        
        
        return $this->render("listarNoticia", ["model" => $model, "form" => $form, "search" => $search, "pages" => $pages]);
    }
    
    
    public function actionEditarnoticia(){
        $model = new FormNoticiaCadastrar();
        $msg = null;
        //Exibir os dados pegando do GET
         if(Yii::$app->request->get("id_noticia")){
            $id_noticia = Html::encode($_GET['id_noticia']);
            if((int) $id_noticia){
                $table = Noticia::findOne($id_noticia);
                if($table){
                    $model->titulo = $table->titulo;
                    $model->corpo = $table->corpo;
                    $model->id = $id_noticia;
                }else{
                     return $this->redirect(["site/listarnoticias"]);
                }
            }  else {
                return $this->redirect(["site/listarnoticias"]);
            }
        }else{
            return $this->redirect(["site/listarnoticias"]);
        }
        // Fazer a alteração dos dados 
        
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $table = Noticia::findOne($model->id);
                if($table){
                    $table->titulo = $model->titulo;
                    $table->corpo = $model->corpo;
                    $table->data_noticia = date('d/m/Y', time());
                    $sql = (new \yii\db\Query())->select('*')->from('usuario')->where('id =:idUSER', array(':idUSER'=>Yii::$app->user->identity->id))->all();
                    $table->autor = $sql[0]['nome'];
                    if($table->update()){
                        $msg = "Registro atualizado com sucesso!";
                    } else {
                        $msg = "Registro não pode ser atualizado!";
                    }
                }else{
                    $msg = "Registro selecionado não encontrado! ";
                }
            }else{
                $model->getErrors();
            }
        }
        return $this->render("editarNoticia",["msg"=>$msg, "model"=>$model]);
    }
    
     public function actionExibirnoticia(){
         $sql=null;
         if(Yii::$app->request->get("id_noticia")){
            $id_noticia = Html::encode($_GET['id_noticia']);
            if((int) $id_noticia){
                $table = Noticia::findOne($id_noticia);
                if($table){
                    $sql = (new \yii\db\Query())->select('*')->from('noticia')->where('id =:idNOTICIA', array(':idNOTICIA'=>$id_noticia))->all();
                }else{
                    return $this->redirect(["site/listarnoticiasall"]);
                }
            }else {
                return $this->redirect(["site/listarnoticiasall"]);
            }
        }else{
            return $this->redirect(["site/listarnoticiasall"]);
        }
        return $this->render("exibirNoticia", ["sql"=>$sql]);
    }
    public function actionDeletarnoticia() {
        if (Yii::$app->request->post()) {
            $id_noticia = Html::encode($_POST["id_noticia"]);
            if ((int) $id_noticia) {
                if (Noticia::deleteAll("id=:id_noticia", [":id_noticia" => $id_noticia])) {
                        echo "<script language='javascript' type='text/javascript'>"
                        . "alert('Notícia Excluído com sucesso!');</script>";
                        echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("site/listarnoticias") . "'>";
                } else {
                    echo "Erro ao excluir notícia, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("site/listarnoticias") . "'>";
                }
            } else {
                echo "Erro ao excluir notícia, tente novamente ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("site/listarnoticias") . "'>";
            }
        } else {
            return $this->redirect(["site/listarnoticias"]);
        }
    }
    public function actionListarnoticiasall(){
       $table = Noticia::find()->orderBy([
                    'data_noticia' => SORT_DESC
                     ]);
            $count = clone $table;
            $pages = new Pagination([
                "pageSize" => 10,
                "totalCount" => $count->count(),
            ]);
            $model = $table
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        
        return $this->render("listarNoticias_all", ["model" => $model, "pages" => $pages]);
    }
    public function noticias_capa() {
        $sql = (new \yii\db\Query())->select('*')->from('noticia')->orderBy([
                    'data_noticia' => SORT_DESC
                     ])->all();
                return $sql;
    }
    
}
