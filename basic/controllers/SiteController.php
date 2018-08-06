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
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\helpers\Url;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
    
}
