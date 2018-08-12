<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<h3>Painel de controle do site</h3>
<h5>*Para a imagem do site será aceito imagens dos tipos: .png e .jpg.</h5>
<h5>*Adicione também um título e uma descrição.</h5>
<h5>*Caso você não atualize, a imagem continuará a mesma.</h5>
<a href="<?=Url::toRoute("usuario/index3")?>">Voltar para o Menu</a><br/>
<div class="alert alert-primary" role="alert"><?=$msg?></div>
<?php $form = ActiveForm::begin([
     "method" => "post",
     "enableClientValidation" => true,
     "options" => ["enctype" => "multipart/form-data"],
     ]);
?>

<div class="form-group">
    <?= $form->field($model, 'titulo')->textArea() ?>
</div>
<div class="form-group">
    <?= $form->field($model, 'descricao')->textArea() ?>
</div>
<div class="form-group">
    <?= $form->field($model, "imagem")->fileInput() ?>
    <?php if(isset($link)){ 
         echo "<img src='".$link."' width='100' height='100' /><br/><br/>";
     } ?>      
<?= Html::submitButton("Enviar", ["class" => "btn btn-primary"]) ?>
</div>
<?php $form->end() ?>