<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
?>
<!--<a href="<? = Url::toRoute("site/listar")?>">Cadastro de Usuário</a>-->
<h2>Editar usuário: <?php if(isset($_GET['nome'])){ echo $_GET['nome'];} ?></h2>

<h4>Atenção ADMINISTRADOR, essas alterações são de inteira responsabilidade sua!</h4>
<?php if($msg != null){ ?>
    <div class="alert alert-info" ><?=$msg?></div>
<?php }?>
    <a href="<?=Url::toRoute("site/listarnoticias")?>">Listar Notícias</a><br/>
<?php
$form = ActiveForm::begin(
                ["method" => "post",
                    "enableClientValidation" => true]);
?>
<?= $form->field($model, "id")->input("hidden")->label(false)?>

<div class="form-group">
<?= $form->field($model, "titulo")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, 'corpo')->widget(CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'advance'
	]) ?>
</div>

<?= Html::submitButton("Atualizar", ["class" => "btn btn-primary"]);?>

<?php $form->end();?>