<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<a href="<?= Url::toRoute("usuario/index")?>">Listar Propostas</a>
<h1>Editar Proposta <?= Html::encode($_GET['descricao'])?> ...</h1>
<div class="alert alert-primary" role="alert"><?=$msg?></div>
<?php
$form = ActiveForm::begin(
                ["method" => "post",
                    "enableClientValidation" => true]);
?>
<?= $form->field($model, "id")->input("hidden")->label(false)?>

<div class="form-group">
<?= $form->field($model, "descricao")->input("text"); ?>
</div>

<?= $form->field($model, 'tipo')->dropDownList(
			['Palestra' => 'Palestra', 'Minicurso'=> 'Minicurso', 'Mesa redonda'=> 'Mesa redonda']
			); ?> 

<?= $form->field($model, 'area_conhecimento')->dropDownList(
			['Computação e Tecnologia' => 'Computação e Tecnologia', 'Contabéis'=> 'Contabéis', 'Matemática'=> 'Matemática','Geografia'=>'Geografia','História'=>'História','Direito'=>'Direito','Pedagogia'=>'Pedagogia']
			); ?> 

<?= Html::submitButton("Atualizar", ["class" => "btn btn-primary"]);?>

<?php $form->end();?>