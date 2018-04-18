<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!--<a href="<? = Url::toRoute("site/listar")?>">Cadastro de Usuário</a>-->
<h2>Editar usuário: <?php if(isset($_GET['nome'])){ echo $_GET['nome'];} ?></h2>

<h4>Atenção ADMINISTRADOR, essas alterações são de inteira responsabilidade sua!</h4>
<?php if($msg != null){ ?>
    <div class="alert alert-info" ><?=$msg?></div>
<?php }?>
    <a href="<?=Url::toRoute("usuario/listar")?>">Listar Usuários</a><br/>
<?php
$form = ActiveForm::begin(
                ["method" => "post",
                    "enableClientValidation" => true]);
?>
<?= $form->field($model, "id")->input("hidden")->label(false)?>

<div class="form-group">
<?= $form->field($model, "nome")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "username")->input("text"); ?>
</div>

<div class="form-group">  
 <?= $form->field($model, "email")->input("email"); ?> 
</div>

<div class="form-group">
<?= $form->field($model, "cpf")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "endereco")->input("text"); ?>
</div>

<div class="form-group">
<?= $form->field($model, "instituicao")->input("text"); ?>
</div>


<?= $form->field($model, 'role')->dropDownList(
			[1 => 'Participante', 2 => 'Chefe de Departamento', 3 => 'Administrador']
			); ?>    


<?= Html::submitButton("Atualizar", ["class" => "btn btn-primary"]);?>

<?php $form->end();?>