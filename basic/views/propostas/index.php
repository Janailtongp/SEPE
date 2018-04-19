



<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
$f = ActiveForm::begin([
            "method" => "get",
            "action" => Url::toRoute("propostas/index"),
            "enableClientValidation" => true,
        ])
?>
<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>
<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>




<h3>Minhas Propostas</h3>

<table class="table table-bordered">
    <tr>
        <th>Descrição</th>
        <th>Status</th>
        <th>Tipo</th>
        <th></th>

    </tr>
    <?php foreach ($model as $row): ?>
        <tr>
            <td><?= $row->descricao ?></td>
            <td><?= $row->status ?></td>
            <td><?= $row->tipo?></td>
            <td><a href="<?= Url::toRoute(["propostas/editar","id"=>$row->id, "descricao"=>$row->descricao])?>"><i class="
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
                                            <p>Deseja realmente excluir o registro desta proposta: <?= $row->descricao?> <?= $row->tipo?> ?</p>    
                                        </div>
                                        <div class='modal-footer'>
                                            <?= Html::beginForm(Url::toRoute("propostas/delete"), "POST") ?>
                                                <input type="hidden" name="id" value="<?= $row->id?>">
                                                <button type="submit" class="btn btn-primary">Excluir</button>
                                            <?= Html::endForm()?>
                                        </div>
                                    </div>
                                </div>
                    </div>
            </tr>
<?php endforeach; ?>
            <tr><td><a href="<?= Url::toRoute("propostas/cadastrar") ?>">Adicionar uma nova Proposta</a><td></td><td></td><td></td>
</td></tr>
</table>

<?=
LinkPager::widget([
    "pagination" => $pages,
])
?>

