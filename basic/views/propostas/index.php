



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




<h3>Propostas</h3>

<table class="table table-bordered">
    <tr>
        <th>Participante</th>

        <th>Descrição</th>
        <th>Status</th>
        <th>Tipo</th>
        <th></th>
        <th></th>

    </tr>
    <?php foreach ($model as $row): ?>
        <tr>
  <td><?php 
            $tamanho = count($usuarios);
            if($tamanho > 0){
                for($i =0; $i<$tamanho; $i++){
                    if($usuarios[$i]['id']==$row->id_participante){
                        $nome_usuario=$usuarios[$i]['usuario'];
                    }
                }
            }
           echo $nome_usuario;
                    ?></td>
            <td><?= $row->descricao ?></td>
            <td><?= $row->status ?></td>
            <td><?= $row->tipo?></td>
            <td><?= Html::beginForm(Url::toRoute("propostas/aprovar"), "POST") ?>
                                                <input type="hidden" name="id" value="<?= $row->id?>">
                                                <button type="submit" class="btn btn-success">Aprovar</button>
                                            <?= Html::endForm()?>
            </td><td>
            <?= Html::beginForm(Url::toRoute("propostas/desaprovar"), "POST") ?>
                                                <input type="hidden" name="id" value="<?= $row->id?>">
                                                <button type="submit" class="btn btn-danger">Desaprovar</button>
                                            <?= Html::endForm()?>
            </td>
         

           
            
              
            </tr>
<?php endforeach; ?>
            
</table>

<?=
LinkPager::widget([
    "pagination" => $pages,
])
?>

