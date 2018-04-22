<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!--<a href="<? = Url::toRoute("site/listar")?>">Cadastro de Usuário</a>-->
<h1>Avaliar submissão de: <?=$model2->nome?></h1>
<a href="javascript:history.back()">Voltar</a><br/>
<?php if($msg != null){ ?>
    <div class="alert alert-info" ><?=$msg?></div>
<?php }?>
    <p>Caro corretor, essas são algumas informações sobre o remetente da submissão, utilize os mesmos 
        para entrar em contato caso seja necessário.</p>
    <p>Nome: <?=$model2->nome?></p>
    <p>E-mail: <?=$model2->email?></p>
<?php

$form = ActiveForm::begin(
                ["method" => "post",
                    "enableClientValidation" => true]);
?>
<?= $form->field($model, "id")->input("hidden")->label(false)?>

<div class="form-group">
<?= $form->field($model, "data_apresentacao")->input("date"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "horario_apresentacao")->input("text"); ?>
</div>

<div class="form-group">  
 <?= $form->field($model, "nota")->input("text"); ?> 
</div>

<div class="form-group">
<?= $form->field($model, "observacao_avaliacao")->input("text"); ?>
</div>
    
<?= $form->field($model, 'status')->dropDownList(
			["Em correção" => 'Em correção', "Aprovado" => 'Aprovado', "Reprovado" => 'Reprovado']
			); ?>  
    
<?= Html::submitButton("Concluir Avaliação", ["class" => "btn btn-primary"]);?>

<?php $form->end();?>
