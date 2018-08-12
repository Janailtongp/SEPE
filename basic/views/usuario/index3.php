<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Administrador';
$this->params['Administrador'][] = $this->title;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="site-index">

    <div class="jumbotron">
        <h3>Bem vindo Administrador!</h3>
<br/>
        <p class="lead">
     

<!-- /. ROW  --> 
<div class="row text-center pad-top">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
        <div class="div-square">
            <a href="<?=Url::toRoute("evento/index")?>" >
                <i class="fa fa-calendar fa-4x"></i>
                <h4>Eventos</h4>
            </a>
        </div>


    </div> 

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
        <div class="div-square">
            <a href="<?=Url::toRoute("propostas/index")?>" >
                <i class="fa fa-commenting fa-4x"></i>
                <h4>Propostas</h4>
            </a>
        </div>


    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
        <div class="div-square">
            <a href="<?=Url::toRoute("usuario/listar")?>" >
                <i class="fa fa-users fa-4x"></i>
                <h4>Usuários</h4>
            </a>
        </div>


    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
        <div class="div-square">
            <a href="<?=Url::toRoute("site/painel")?>" >
                <i class="fa fa-desktop fa-4x"></i>
                <h4>Painel do Site</h4>
            </a>
        </div>


    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
        <div class="div-square">
            <a href="<?=Url::toRoute("site/listarnoticias")?>" >
                <i class="fa fa-newspaper-o fa-4x"></i>
                <h4>Notícias</h4>
            </a>
        </div>


    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">  
        <div class="div-square">
            <a href="<?=Url::toRoute("usuario/meusdados")?>" >
                <i class="fa fa-address-card fa-4x"></i>
                <h4>Meus dados</h4>
            </a>
        </div>


    </div>
</div>
            
        </p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">


            </div>
            
        </div>

    </div>
</div>
