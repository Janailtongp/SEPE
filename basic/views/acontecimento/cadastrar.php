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
<?= $form->field($model,'ministrante')->input("text");?>
<?= $form->field($model, 'local_acontecimento')->input("text"); ?>
<?= $form->field($model, 'tipo')->dropDownList(
			['Palestra' => 'Palestra', 'Minicurso'=> 'Minicurso', 'Mesa redonda'=> 'Mesa redonda']
			); ?> 
<?= $form->field($model, 'status')->dropDownList(
			['Aberto' => 'Aberto', 'Fechado'=> 'Fechado']
			); ?> 
<?= $form->field($model, 'id_evento')->input("text"); ?>
<?= $form->field($model, 'data_inicio')->input("text"); ?>
<?= $form->field($model, 'data_fim')->input("text"); ?>

<div class='form-group'>
    <?= HTML::submitButton('Cadastrar',['class'=>'btn btn-primary'])?>
</div>
<?php  ActiveForm::end()?>
