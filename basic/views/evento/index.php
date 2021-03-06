



<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;

$f = ActiveForm::begin([
            "method" => "get",
            "action" => Url::toRoute("evento/index"),
            "enableClientValidation" => true,
        ])
?>
<div clas="row">
    
    <ul class="breadcrumb">
    <li><a href="<?=Url::toRoute("evento/index")?>">Eventos</a></li>
    <li><a href="<?=Url::toRoute("usuario/listar")?>">Usuários</a></li>
    <li><a href="<?=Url::toRoute("propostas/index")?>">Propostas</a></li>
  </ul>
    
</div>
<div class="form-group">
<?= $f->field($form, "q")->input("search") ?>
</div>
<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>




<h3>Lista de Eventos</h3>

<table class="table table-striped">
    <tr>
        <th>Descrição</th>
        <th>Local do Evento</th>
        <th>Data Inicio</th>
        <th>Data Fim</th>
        <th></th>
        <th></th>
                <th></th>

        <th></th>

    </tr>
<?php foreach ($model as $row): ?>
        <tr>
            <td><?= $row->descricao ?></td>
            <td><?= $row->local_evento ?></td>
            <td><?= $row->data_inicio ?></td>
            <td><?= $row->data_fim ?></td>
            <td><a href="<?= Url::toRoute(["evento/editar", "id" => $row->id, "descricao" => $row->descricao]) ?>"><i class="
                                                                                                                glyphicon glyphicon-cog"></i></a>
                <a href="#" data-toggle='modal' data-target="#myModal<?= $row->id ?>"><i class="glyphicon glyphicon-trash"></i></a>

            </td>
            <td><?= Html::beginForm(Url::toRoute("acontecimento/index"), "GET") ?>
                <input type="hidden" name="id" value="<?= $row->id ?>">
                <button type="submit" class="btn btn-primary">Acontecimentos</button>
    <?= Html::endForm() ?>
            </td>
            <td>
                <a class="btn btn-primary" href="<?= Url::toRoute(["artigo/listar", "id_evento" => $row->id,"titulo"=>$row->descricao]) ?>">Submissões</a>
            </td>
              <td>
                <a class="btn btn-primary" href="<?= Url::toRoute(["evento/participante", "id_evento" => $row->id,"titulo"=>$row->descricao]) ?>">Participantes</a>
            </td>
            <?php ?>
        <div class='modal fade' id=myModal<?= $row->id ?> tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Excluir registro!</h4>
                    </div>
                    <div class='modal-body'>
                        <p>Deseja realmente excluir o registro deste evento: <?= $row->descricao ?> <?= $row->local_evento ?> ?</p>    
                    </div>
                    <div class='modal-footer'>
                        <?= Html::beginForm(Url::toRoute("evento/delete"), "POST") ?>
                        <input type="hidden" name="id" value="<?= $row->id ?>">
                        <button type="submit" class="btn btn-primary">Excluir</button>
                        <?= Html::endForm() ?>
                    </div>
                </div>
            </div>
        </div>
    </tr>
<?php endforeach; ?>
    <tr><td><a href="<?= Url::toRoute("evento/cadastrar") ?>"><i class="	glyphicon glyphicon-plus"></i></a><td></td><td></td><td></td><td></td><td></td>
    <td></td> <td></td></tr>
</table>

<?=
LinkPager::widget([
    "pagination" => $pages,
])
?>

