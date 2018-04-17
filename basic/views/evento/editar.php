<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<a href="<?= Url::toRoute("evento/index")?>">Listar Eventos</a>
<h1>Editar Evento <?= Html::encode($_GET['descricao'])?> ...</h1>
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

<div class="form-group">
<?= $form->field($model, "local_evento")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "data_inicio")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "data_fim")->input("text"); ?>
</div>



<?= Html::submitButton("Atualizar", ["class" => "btn btn-primary"]);?>

<?php $form->end();?>