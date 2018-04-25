<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<h2>Cadastrar Proposta</h2>
<hr>
<a href="<?= Url::toRoute("usuario/index")?>">Tela Inicial</a>

<div class="alert alert-primary" role="alert"><?=$msg?></div>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model,'descricao')?>
<?= $form->field($model, 'tipo')->dropDownList(
			['Palestra' => 'Palestra', 'Minicurso'=> 'Minicurso', 'Mesa redonda'=> 'Mesa redonda']
			); ?>
<?= $form->field($model, 'area_conhecimento')->dropDownList(
			['Computação e Tecnologia' => 'Computação e Tecnologia', 'Contabéis'=> 'Contabéis', 'Matemática'=> 'Matemática','Geografia'=>'Geografia','História'=>'História','Direito'=>'Direito','Pedagogia'=>'Pedagogia']
			); ?> 


<div class='form-group'>
    <?= HTML::submitButton('Cadastrar',['class'=>'btn btn-primary'])?>
</div>
<?php  ActiveForm::end()?>
