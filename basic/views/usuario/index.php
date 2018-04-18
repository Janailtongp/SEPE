<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<h3>Bem vindo(a) ao sistema SEPE</h3><br/>
<h4>Aqui você fica por dentro de tudo o que acontece no Seminário de Ensino, Pesquisa e Extensão do CERES-UFRN </h4>

<a href="<?=Url::toRoute("evento/index")?>">Eventos Abertos</a><br/>
<a href="<?=Url::toRoute("usuario/meusdados")?>">Alterar meus dados</a>