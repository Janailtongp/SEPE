<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Chefe de departamento';
$this->params['Chefe de departamento'][] = $this->title;
?>
<h1>Chefe de Departamento</h1>

<a href="<?=Url::toRoute("evento/index")?>" class="btn btn-primary">MENU Eventos</a> 
<a href="<?=Url::toRoute("usuario/listar")?>" class="btn btn-primary">MENU Usuario</a><br/>