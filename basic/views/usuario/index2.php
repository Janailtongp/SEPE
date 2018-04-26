<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Chefe de departamento';
$this->params['Chefe de departamento'][] = $this->title;
?>
<div class="site-index">

    <div class="jumbotron">
        <h3>Chefe de Departamento!</h3>

        <p class="lead">
            <a href="<?=Url::toRoute("evento/index")?>" class="btn btn-primary">Eventos</a> 
            <a href="<?=Url::toRoute("usuario/meusdados")?>" class="btn btn-warning">Meus Dados</a>

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
