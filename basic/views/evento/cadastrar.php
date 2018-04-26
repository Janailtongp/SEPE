<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<div clas="row">
    
   <div clas="row">
    
    <ul class="breadcrumb">
    <li><a href="<?=Url::toRoute("evento/index")?>">Eventos</a></li>
    <li><a href="<?=Url::toRoute("usuario/listar")?>">Usuários</a></li>
    <li><a href="<?=Url::toRoute("propostas/index")?>">Propostas</a></li>
  </ul>
    
</div>
    
</div>
<h2>Cadastrar Evento</h2>
<hr>

<div class="alert alert-primary" role="alert"><?=$msg?></div>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model,'descricao')?>
<?= $form->field($model, 'local_evento') ?>
<?= $form->field($model, 'data_inicio') ?>
<?= $form->field($model, 'data_fim') ?>

<div class='form-group'>
    <?= HTML::submitButton('Cadastrar',['class'=>'btn btn-primary'])?>
</div>
<?php  ActiveForm::end()?>
