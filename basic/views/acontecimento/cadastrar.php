<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<h2>Cadastrar Acontecimento</h2>
<hr>
<a href="<?= Url::toRoute("evento/index")?>">Listar Acontecimentos</a>

<div class="alert alert-primary" role="alert"><?=$msg?></div>

<?php $form = ActiveForm::begin(
                    ["method" => "post",
                    "enableClientValidation" => true]); ?>

<?= $form->field($model,'descricao')->input("text");?>
<?= $form->field($model, 'local_acontecimento')->input("text"); ?>
<?= $form->field($model, 'tipo')->input("text"); ?>
<?= $form->field($model, 'status')->input("text"); ?>
<?= $form->field($model, 'id_usuario')->input("text"); ?>
<?= $form->field($model, 'id_evento')->input("text"); ?>
<?= $form->field($model, 'data_inicio')->input("date"); ?>
<?= $form->field($model, 'data_fim')->input("date"); ?>

<div class='form-group'>
    <?= HTML::submitButton('Cadastrar',['class'=>'btn btn-primary'])?>
</div>
<?php  ActiveForm::end()?>
