
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;

$f = ActiveForm::begin([
            "method" => "get",
            "action" => Url::toRoute("acontecimento/index"),
            "enableClientValidation" => true,
        ])
?>
<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>
<input type="hidden" name="id" value="<?= $id?>">

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>




<h3>Lista de Acontecimentos</h3>

<table class="table table-bordered">
    <tr>
        <th>Descrição</th>
        <th>Tipo</th>
        <th>Evento</th>
        <th>Ministrante(s)</th>
        <th>Local do Acontecimento</th>
        <th>Data Inicio</th>
        <th>Data Fim</th>
        <th>Usuário</th>
        <th>Status</th>

        <th></th>
               <th></th>

    </tr>
    <?php foreach ($model as $row): ?>
        <tr>
            <td><?= $row->descricao ?></td>
            <td><?= $row->tipo ?></td>
            <td><?= $row->id_evento?></td>
            <td><?= $row->ministrante ?></td>
            <td><?= $row->local_acontecimento ?></td>
            <td><?= $row->data_inicio ?></td>
            <td><?= $row->data_fim ?></td>
            <td><?= $row->id_usuario ?></td>
            
            <td><?= $row->status ?></td>

            <td><a href="<?= Url::toRoute(["acontecimento/editar","id"=>$row->id, "descricao"=>$row->descricao,"id_evento"=>$id])?>"><i class="
glyphicon glyphicon-cog"></i></a>
           
                <a href="#" data-toggle='modal' data-target="#myModal<?= $row->id ?>"><i class="glyphicon glyphicon-trash"></i></a>
</td>
                    <div class='modal fade' id=myModal<?= $row->id?> tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h4 class='modal-title' id='myModalLabel'>Excluir registro!</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Deseja realmente excluir o registro deste acontecimento: <?= $row->descricao?> <?= $row->local_acontecimento?> ?</p>    
                                        </div>
                                        <div class='modal-footer'>
                                            <?= Html::beginForm(Url::toRoute("acontecimento/delete"), "POST") ?>
                                                <input type="hidden" name="id" value="<?= $row->id?>">
                                                <input type="hidden" name="id_evento" value="<?= $id?>">

                                                <button type="submit" class="btn btn-primary">Excluir</button>
                                            <?= Html::endForm()?>
                                        </div>
                                    </div>
                                </div>
                    </div>
         <td><?= Html::beginForm(Url::toRoute("acontecimento/inscrever"), "POST") ?>
                                                <input type="hidden" name="id" value="<?= $row->id?>">
                                                <input type="hidden" name="id_evento" value="<?= $id?>">

                                                <button type="submit" class="btn btn-primary">Inscrever-se</button>
                                            <?= Html::endForm()?></td>
            </tr>
<?php endforeach; ?>
            <tr><td><a href="<?= Url::toRoute(["acontecimento/cadastrar","id_evento"=>$id]) ?>"><i class="glyphicon glyphicon-plus"></i></a><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                <td></td></tr>
</table>

<?=
LinkPager::widget([
    "pagination" => $pages,
])
?>

