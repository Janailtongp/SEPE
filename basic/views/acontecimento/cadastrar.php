<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<h2>Cadastrar Evento</h2>
<hr>
<a href="<?= Url::toRoute("evento/index")?>">Listar Eventos</a>

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
