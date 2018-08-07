<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;
?>
<h3>Cadastrar notícia</h3>
<a href="<?=Url::toRoute("usuario/index")?>">Voltar para o Menu</a><br/>
<div class="alert alert-primary" role="alert"><?=$msg?></div>
<?php $form = ActiveForm::begin([
     "method" => "post",
     "enableClientValidation" => true,
     "options" => ["enctype" => "multipart/form-data"],
     ]);
?>

<div class="form-group">
    <?= $form->field($model, 'titulo')->textInput() ?>
</div>
<?= $form->field($model, 'corpo')->widget(CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'advance'
	]) ?>

<?= Html::submitButton("Publicar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>