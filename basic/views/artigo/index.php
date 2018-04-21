<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<h3>Submeter artigo ao evento.</h3>
<h5>Formatos aceitos: .doc e .pdf.</h5>
<h5>Você so pode submeter um artigo por evento, que será avalidado e aprovado/reprovado.</h5>
<h5>Caso seja aprovado você verá todas as informações necessarias para sua apresentação na aba MENU.</h5>
<a href="<?=Url::toRoute("usuario/index")?>">Voltar para o Menu</a><br/>
<div class="alert alert-primary" role="alert"><?=$msg?></div>
<?php $form = ActiveForm::begin([
     "method" => "post",
     "enableClientValidation" => true,
     "options" => ["enctype" => "multipart/form-data"],
     ]);
?>

<div class="form-group">
    <?= $form->field($model, 'resumo')->textArea() ?>
</div>

<?= $form->field($model, "file")->fileInput() ?>

<?= Html::submitButton("Enviar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>