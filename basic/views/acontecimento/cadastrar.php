<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<h2>Cadastrar Acontecimento</h2>
<hr>
<a href="<?= Url::toRoute("evento/index")?>">Listar Acontecimentos</a>

<div class="alert alert-primary" role="alert"><?=$msg?></div>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model,'descricao')?>
<?= $form->field($model, 'local_acontecimento') ?>
<?= $form->field($model, 'tipo') ?>
<?= $form->field($model, 'status') ?>
<?= $form->field($model, 'id_usuario') ?>
<?= $form->field($model, 'id_evento') ?>

<?= $form->field($model, 'data_inicio') ?>
<?= $form->field($model, 'data_fim') ?>

<div class='form-group'>
    <?= HTML::submitButton('Cadastrar',['class'=>'btn btn-primary'])?>
</div>
<?php  ActiveForm::end()?>
