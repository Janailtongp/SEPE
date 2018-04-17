<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!--<a href="<? = Url::toRoute("site/listar")?>">Cadastro de Usuário</a>-->
<h1>Cadastro de Usuário</h1>
<div class="alert alert-primary" role="alert"><?=$msg?></div>
<?php
$form = ActiveForm::begin(
                ["method" => "post",
                    "enableClientValidation" => true]);
?>

<div class="form-group">
<?= $form->field($model, "nome")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "username")->input("text"); ?>
</div>

<div class="form-group">  
 <?= $form->field($model, "email")->input("email"); ?> 
</div>

<div class="form-group">
<?= $form->field($model, "cpf")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "endereco")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "instituicao")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "password")->input("password"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "confsenha")->input("password"); ?>
</div>



<?= Html::submitButton("Enviar", ["class" => "btn btn-primary"]);?>

<?php $form->end();?>