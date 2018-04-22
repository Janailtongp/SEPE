<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<a href="<?= Url::toRoute("usuario/cadastrar") ?>">Adicionar um novo usuario</a>

<?php
$f = ActiveForm::begin([
            "method" => "get",
            "action" => Url::toRoute("usuario/listar"),
            "enableClientValidation" => true,
        ])
?>
<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>
<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>

<!--<h3><? = $search ?></h3>--> 


<h3>Lista de Usuários</h3>

<table class="table table-bordered">
    <tr>
        <th>ID Usuario</th>
        <th>Nome</th>
        <th>Login</th>
        <th>email</th>
        <th>CPF</th>
        <th>Endereço</th>
        <th>Nível</th>
        <th>Instituição</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($model as $row): ?>
        <tr>
            <td><?= $row->id ?></td>
            <td><?= $row->nome ?></td>
            <td><?= $row->username ?></td>
            <td><?= $row->email ?></td>
            <td><?= $row->cpf ?></td>
            <td><?= $row->endereco ?></td>
            <td><?= $row->role ?></td>
            <td><?= $row->instituicao ?></td>
            <td><a href="<?= Url::toRoute(["usuario/editar","id_usuario"=>$row->id, "nome"=>$row->nome])?>">Editar</a></td>
            <td>
                <a href="#" data-toggle='modal' data-target="#myModal<?= $row->id ?>">Excluir</a>
            </td>
                    <div class='modal fade' id=myModal<?= $row->id?> tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h4 class='modal-title' id='myModalLabel'>Excluir registro!</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Deseja realmente excluir o usuário de Nome: <?= $row->nome?><br/> CPF: <?= $row->cpf?> ?</p>    
                                        </div>
                                        <div class='modal-footer'>
                                            <?= Html::beginForm(Url::toRoute("usuario/delete"), "POST") ?>
                                                <input type="hidden" name="id_usuario" value="<?= $row->id?>">
                                                <button type="submit" class="btn btn-primary">Excluir</button>
                                            <?= Html::endForm()?>
                                        </div>
                                    </div>
                                </div>
                    </div>
            </tr>
<?php endforeach; ?>
</table>

<?=
LinkPager::widget([
    "pagination" => $pages,
])
?>
