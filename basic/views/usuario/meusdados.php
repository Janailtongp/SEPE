<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!--<a href="<? = Url::toRoute("site/listar")?>">Cadastro de Usuário</a>-->
<h1>Meus dados</h1>
<?php if($msg != null){ ?>
    <div class="alert alert-info" ><?=$msg?></div>
<?php }?>
    <a href="javascript:history.back()" class="btn btn-success">Voltar</a><br/>
<?php

$form = ActiveForm::begin(
                ["method" => "post",
                    "enableClientValidation" => true]);
?>
<?= $form->field($model, "id")->input("hidden")->label(false)?>

<div class="form-group">
<?= $form->field($model, "nome")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "username")->input("text", ['readonly' => true]); ?>
</div>

<div class="form-group">  
 <?= $form->field($model, "email")->input("email", ['readonly' => true]); ?> 
</div>

<div class="form-group">
<?= $form->field($model, "cpf")->input("text", ['readonly' => true]); ?>
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
<?= Html::submitButton("Atualizar", ["class" => "btn btn-primary"]);?>

<?php $form->end();?>