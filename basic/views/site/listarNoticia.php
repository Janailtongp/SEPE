<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<a href="<?= Url::toRoute("site/cadastrarnoticia") ?>">Adicionar uma nova notícia</a>

<?php
$f = ActiveForm::begin([
            "method" => "get",
            "action" => Url::toRoute("site/listarnoticias"),
            "enableClientValidation" => true,
        ])
?>
<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>
<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>

<!--<h3><? = $search ?></h3>--> 


<h3>Lista de Notícias</h3>

<table class="table table-bordered">
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Resumo da postagem</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($model as $row): ?>
        <tr>
            <td><?= $row->titulo ?></td>
            <td><?= $row->autor ?></td>
            <td><?= substr(strip_tags($row->corpo), 0, 100)." [...]" ?>
                <a href="<?= Url::toRoute(["site/exibirnoticia","id_noticia"=>$row->id])?>">Ver no site</a>
            </td>
            <td><a href="<?= Url::toRoute(["site/editarnoticia","id_noticia"=>$row->id, "tloitu"=>$row->titulo])?>">Editar</a></td>
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
                                            <p>Deseja realmente excluir a notícia: <?= $row->titulo?><br/> do autor: <?= $row->autor?> ?</p>    
                                        </div>
                                        <div class='modal-footer'>
                                            <?= Html::beginForm(Url::toRoute("site/deletarnoticia"), "POST") ?>
                                                <input type="hidden" name="id_noticia" value="<?= $row->id?>">
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
