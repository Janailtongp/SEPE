<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Administrador';
$this->params['Administrador'][] = $this->title;
?>
<h1>Administrador</h1>
<a href="<?=Url::toRoute("evento/index")?>">Gerenciar Eventos</a><br/>
<a href="<?=Url::toRoute("propostas/index")?>">Gerenciar Propostas</a>
