<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<a href="<?= Url::toRoute(["acontecimento/index","id"=>Html::encode($_GET['id_evento'])])?>" class="btn btn-success">Listar Acontecimentos</a>
<h1>Editar Acontecimento <?= Html::encode($_GET['descricao'])?> ...</h1>
<div class="alert alert-sucess" role="alert"><?=$msg?></div>
<?php
$form = ActiveForm::begin(
                ["method" => "post",
                    "enableClientValidation" => true]);
?>
<?= $form->field($model, "id")->input("hidden")->label(false)?>

<div class="form-group">
<?= $form->field($model, "descricao")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "ministrante")->input("text"); ?>
</div>
<div class="form-group">
<?= $form->field($model, "local_acontecimento")->input("text"); ?>
</div>
<?= $form->field($model, 'tipo')->dropDownList(
			['Palestra' => 'Palestra', 'Minicurso'=> 'Minicurso', 'Mesa redonda'=> 'Mesa redonda']
			); ?> 
<?= $form->field($model, 'area_conhecimento')->dropDownList(
			['Computação e Tecnologia' => 'Computação e Tecnologia', 'Contabéis'=> 'Contabéis', 'Matemática'=> 'Matemática','Geografia'=>'Geografia','História'=>'História','Direito'=>'Direito','Pedagogia'=>'Pedagogia']
			); ?> 
<?= $form->field($model, 'status')->dropDownList(
			['Aberto' => 'Aberto', 'Fechado'=> 'Fechado']
			); ?> 
<?= $form->field($model, 'data_inicio')->input("text"); ?>
<?= $form->field($model, 'data_fim')->input("text"); ?>



<?= Html::submitButton("Atualizar", ["class" => "btn btn-primary"]);?>

<?php $form->end();?>