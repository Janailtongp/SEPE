<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Administrador';
$this->params['Administrador'][] = $this->title;
?>

<div class="site-index">

    <div class="jumbotron">
        <h3>Bem vindo Administrador!</h3>

        <p class="lead">
            <a href="<?=Url::toRoute("evento/index")?>" class="btn btn-primary">Eventos</a> 
            <a href="<?=Url::toRoute("propostas/index")?>" class="btn btn-warning">Propostas</a>
            <a href="<?=Url::toRoute("usuario/listar")?>" class="btn btn-success">Usuários</a>

<br/>
            
        </p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">


            </div>
            
        </div>

    </div>
</div>
