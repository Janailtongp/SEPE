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
use app\models\Inscricao_Acontecimento;

class AcontecimentoController extends Controller {
     public function Listar_meus_acontecimentos($idUSuario,$id_evento){
           
                $sql = (new \yii\db\Query())->select('a.descricao descricao,a.tipo tipo,u.nome usuario,a.ministrante ministrante,a.local_acontecimento local_acontecimento,a.data_inicio data_inicio,a.data_fim data_fim,e.descricao evento,a.id id,i.id id_inscricao')->from('acontecimento a, inscricao_acontecimento i,evento e,usuario u')
                        ->where('a.id = i.id_acontecimento')->andWhere('a.id_evento=e.id')
                        ->andWhere('e.id=:id', array(':id'=>$id_evento))
                        ->andWhere('i.id_participante=:id', array(':id'=>$idUSuario))->andWhere(('a.id_usuario = u.id'))->all();
                return $sql;
        }
        
        public function Outros_acontecimentos($id_evento) {
            //Selecionar todos os eventos Que eu não participo
           $sql = (new \yii\db\Query())->select('a.descricao descricao,a.tipo tipo,u.nome usuario,a.ministrante ministrante,a.local_acontecimento local_acontecimento,a.data_inicio data_inicio,a.data_fim data_fim,e.descricao evento,a.id id')->from('acontecimento a,evento e,usuario u')
                        ->where('a.id_evento=e.id')
                        ->andWhere('e.id=:id', array(':id'=>$id_evento))
                        ->andWhere(('a.id_usuario = u.id'))->all();
                return $sql;
        }
       public function actionInscrever() {
        if(Yii::$app->request->post()){
            $id = Html::encode($_POST["id"]);
             $id_evento = Html::encode($_POST['id_evento']);
            $descricao = Html::encode($_POST['descricao']);
                if((int) $id){

                   $inscricao=  new Inscricao_Acontecimento();
                   $inscricao->id_acontecimento=$id;
                   $inscricao->id_participante=Yii::$app->user->identity->id;
                   $inscricao->status="Aprovada";
                      if($inscricao->insert()){
                        echo "Sua inscrição foi realizada com sucesso no acontecimento!";
                    echo "<meta http-equiv='refresh' content='3; " . Url::toRoute(["usuario/indexacontecimento","id"=>$id_evento,"descricao"=>$descricao]) . "'>";
                          
                      }
                      }

                }else{
                    echo "Error ao se inscrever, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; " . Url::toRoute(["usuario/indexacontecimento","id"=>$id_evento,"descricao"=>$descricao]) . "'>";
                }
    
    } 
    public function actionIndex() {
        $form = new SearchAcontecimento();
        $search = null;
        $usuarios = (new \yii\db\Query())->select('u.nome usuario,u.id id')->from('usuario u')->all();
        $eventos = (new \yii\db\Query())->select('e.descricao evento,e.id id')->from('evento e')->all();

        if (Yii::$app->request->get()) {
            $id = Html::encode($_GET["id"]);
        }else{
                        echo "Erro ao encontrar evento 3!, tente novamente ...";
            echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("evento/index") . "'>";

        }
        if ((int) $id) {
            if (Evento::findOne($id)) {
                // listando acontecimento


                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $search = Html::encode($form->q);
                        $table = Acontecimento::find()->where(["like", "id", $search])
                                ->orWhere(["like", "id_usuario", $search])
                                ->orWhere(["like", "descricao", $search])
                                ->orWhere(["like", "tipo", $search])
                                ->orWhere(["like", "ministrante", $search])
                                ->orWhere(["like", "local_acontecimento", $search])
                                ->orWhere(["like", "data_inicio", $search])
                                ->orWhere(["like", "data_fim", $search])
                                ->orWhere(["like", "status", $search])
                                ->andWhere(array('id_evento' => $id));
                        $count = clone $table;
                        $pages = new Pagination([
                            "pageSize" => 4,
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

                    $table = Acontecimento::find()->where(array('id_evento' => $id));


                    $count = clone $table;
                    $pages = new Pagination([
                        "pageSize" => 4,
                        "totalCount" => $count->count(),
                    ]);
                    $model = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                }
                return $this->render("index", ["model" => $model, "form" => $form, "search" => $search, "pages" => $pages,"id"=>$id,"usuarios"=>$usuarios,"eventos"=>$eventos]);
            } else {
                echo "Erro, tente novamente ... 3";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("evento/index") . "'>";
            }
        } else {
            echo "Erro ao encontrar evento 3!, tente novamente ...";
            echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("evento/index") . "'>";
        }
    }

    public function actionCadastrar() {
        //instanciando model do formulario com as regras
         if (Yii::$app->request->get()) {
            $id_evento = Html::encode($_GET["id_evento"]);
        }else{
                        echo "Erro ao encontrar evento 3!, tente novamente ...";
            echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("evento/index") . "'>";

        }
        if ((int) $id_evento) {
            if (Evento::findOne($id_evento)) {
            }else{
                echo "Erro ao encontrar evento 3!, tente novamente ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("evento/index") . "'>";
            }
        }else{
             echo "Erro ao encontrar evento 3!, tente novamente ...";
            echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("evento/index") . "'>";
        }
            
        $model = new FormAcontecimento();
        $msg = null;
        if ($model->load(Yii::$app->request->post())) {
            $msg = "post Ok"; //PAROU  AQUI ALAN
            if ($model->validate()){
                $msg = "Validado";
                $table = new Acontecimento;
                $table->descricao = $model->descricao;
                $table->ministrante = $model->ministrante;
                $table->local_acontecimento = $model->local_acontecimento;
                $table->data_inicio = $model->data_inicio;
                $table->data_fim = $model->data_fim;
                $table->tipo = $model->tipo;
                $table->id_usuario = Yii::$app->user->identity->id;
                //$table->id_usuario = $model->id_usuario;
                $table->status = $model->status;
                $table->id_evento = $id_evento;

                if ($table->insert()){
                    $msg = "Acontecimento cadastrado com sucesso :D";
                    $model->descricao = null;
                    $model->local_acontecimento = null;
                    $model->data_inicio = null;
                    $model->data_fim = null;
                    $model->tipo = null;
                    $model->status = null;
                    $model->id_evento = null;
                    $model->ministrante = null;
                } else {
                    $msg = "Erro ao cadastrar evento :(";
                }
            } else {
                $model->getErrors();
            }
        }
        return $this->render("cadastrar", ["model" => $model, "msg" => $msg,"id_evento"=>$id_evento]);
     }
    
    
     
    
    public function actionDelete() {
        if (Yii::$app->request->post()) {
            $id = Html::encode($_POST["id"]);
            $id_evento=Html::encode($_POST["id_evento"]);
            if ((int) $id) {
                if (Acontecimento::deleteAll("id=:id", [":id" => $id])) {
                    echo "Registro excluido com sucesso! ...";
                    echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("evento/index") . "'>";
                } else {
                    echo "Erro ao excluir Registro, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("evento/index") . "'>";
                }
            } else {
                echo "Erro ao excluir Registro, tente novamente ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("evento/index") . "'>";
            }
        } else {
            return $this->redirect(["evento/index"]);
        }
    }
      public function frequencia_acontecimento($id_acontecimento){
           
                $sql = (new \yii\db\Query())->select('u.nome usuario')->from('inscricao_acontecimento i,usuario u')
                        ->where('a.i = i.id_acontecimento')->andWhere('a.id_evento=e.id')
                        ->andWhere('e.id=:id', array(':id'=>$id_evento))
                        ->andWhere('i.id_acontecimento=:id', array(':id'=>$id_acontecimento))->all();
                return $sql;
        }
    public function actionFrequencia(){
         if (Yii::$app->request->get()) {
            $id_acontecimento = Html::encode($_GET["id"]);
        }    
        
        return $this->redirect(["acontecimento/frequencia"]);

    }
    public function actionEditar() {
        $model = new FormAcontecimento;
        $msg = null;
        if (Yii::$app->request->get("id")) {
            $id = Html::encode($_GET['id']);
            $id_evento = Html::encode($_GET['id_evento']);

            if ((int) $id) {
                $table = Acontecimento::findOne($id);
                if ($table){
                    $model->id = $table->id;
                    $model->descricao = $table->descricao;
                    $model->local_acontecimento = $table->local_acontecimento;
                    $model->ministrante = $table->ministrante;  
                    $model->data_inicio = $table->data_inicio;
                    $model->data_fim = $table->data_fim;
                } else {
                    return $this->redirect(["acontecimento/index","id"=>$id_evento]);
                }
            } else {
                return $this->redirect(["acontecimento/index","id"=>$id_evento]);
            }
        } else {
            return $this->redirect(["acontecimento/index","id"=>$id_evento]);
        }
        
        
        
        if ($model->load(Yii::$app->request->post())){
            if ($model->validate()) {
                $table = Acontecimento::findOne($model->id);
                if ($table) {
                  $table->descricao = $model->descricao;
                  $table->local_acontecimento = $model->local_acontecimento;
                   $table->ministrante = $model->ministrante;
                   $table->tipo = $model->tipo;
                   $table->status= $model->status;
                   $table->ministrante = $model->ministrante;

                    $table->data_inicio = $model->data_inicio;
                    $table->data_fim = $model->data_fim;
                    
                    if ($table->update()) {
                        $msg = "Nova:".$model->descricao;
                    } else {
                        $msg = "Registro não pode ser atualizado".$table->id;
                    }
                } else {
                    $msg = "Registro selecionado não encontrado!".$table->id;
                }
            } else {
                $model->getErrors();
            }
        }

        
        return $this->render("editar", ["msg" => $msg, "model" => $model]);
    }
     public function actionDeixaracontecimento() {
        if (Yii::$app->request->post()) {
            $id_inscricao = Html::encode($_POST['id_inscricao']);
            $id_evento = Html::encode($_POST['id_evento']);
            $descricao = Html::encode($_POST['descricao']);

            $id_usuario = Yii::$app->user->identity->id;
            if ((int) $id_usuario) {
                if (Inscricao_Acontecimento::deleteAll("id=:id_inscricao",
                                    [":id_inscricao" => $id_inscricao])) {
                    echo "Você deixou o acontecimento com sucesso! ...";
                    echo "<meta http-equiv='refresh' content='3; " . Url::toRoute(["usuario/indexacontecimento","id"=>$id_evento,"descricao"=>$descricao]) . "'>";
                } else {
                    echo "Erro ao deixar Evento, tente novamente ...";
                    echo "<meta http-equiv='refresh' content='3; " .Url::toRoute(["usuario/indexacontecimento","id"=>$id_evento,"descricao"=>$descricao]) . "'>";
                }
            } else {
                echo "Erro ao deixar Evento, tente novamente ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute(["usuario/indexacontecimento","id"=>$id_evento,"descricao"=>$descricao]). "'>";
            }
        } else {
            return $this->redirect(["usuario/index"]);
        }
    }
}
