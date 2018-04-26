<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<h2>Cadastrar Acontecimento</h2>
<hr>
<a href="<?= Url::toRoute(["acontecimento/index","id"=>$id_evento])?>" class="btn btn-success"> Listar Acontecimentos</a>

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
<?= $form->field($model, 'area_conhecimento')->dropDownList(
			['Computação e Tecnologia' => 'Computação e Tecnologia', 'Contabéis'=> 'Contabéis', 'Matemática'=> 'Matemática','Geografia'=>'Geografia','História'=>'História','Direito'=>'Direito','Pedagogia'=>'Pedagogia']
			); ?> 
<?= $form->field($model, 'status')->dropDownList(
			['Aberto' => 'Aberto', 'Fechado'=> 'Fechado']
			); ?> 
<?= $form->field($model, 'data_inicio')->input("date"); ?>
<?= $form->field($model, 'data_fim')->input("date"); ?>
<?= $form->field($model, 'qtd')->input("text"); ?>

<div class='form-group'>
    <?= HTML::submitButton('Cadastrar',['class'=>'btn btn-primary'])?>
</div>
<?php  ActiveForm::end()?>
