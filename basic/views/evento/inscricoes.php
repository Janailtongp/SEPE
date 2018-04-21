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
<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>
<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>



<h3>Minhas Inscrições</h3>

<table class="table table-bordered">
    <tr>
        <th>Descrição</th>
        <th>Local do Evento</th>
        <th>Data Inicio</th>
        <th>Data Fim</th>
        <th></th>
       

    </tr>
    <?php foreach ($model as $row){ ?>
        <tr>
            <td><?= $row->descricao ?></td>
            <td><?= $row->local_evento ?></td>
            <td><?= $row->data_inicio?></td>
            <td><?= $row->data_fim ?></td>
          
            <td><?= Html::beginForm(Url::toRoute("acontecimento/index"), "GET") ?>
                                                <input type="hidden" name="id" value="<?= $row->id?>">
                                                <button type="submit" class="btn btn-primary">Acontecimentos</button>
                                            <?= Html::endForm()?></td>
<?php

?>
         
           
            
                    <div class='modal fade' id=myModal<?= $row->id?> tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h4 class='modal-title' id='myModalLabel'>Excluir registro!</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Deseja realmente excluir o registro deste evento: <?= $row->descricao?> <?= $row->local_evento?> ?</p>    
                                        </div>
                                        <div class='modal-footer'>
                                            <?= Html::beginForm(Url::toRoute("evento/delete"), "POST") ?>
                                                <input type="hidden" name="id" value="<?= $row->id?>">
                                                <button type="submit" class="btn btn-primary">Excluir</button>
                                            <?= Html::endForm()?>
                                        </div>
                                    </div>
                                </div>
                    </div>
            </tr>
<?php } ?>
        
</table>

<?=
LinkPager::widget([
    "pagination" => $pages,
])
?>

