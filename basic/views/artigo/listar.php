<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<a href="<?=Url::toRoute("evento/index")?>" >Voltar para EVENTOS</a> 
<h3>Lista de submissões para o evento: <?= $titulo ?></h3>

<table class="table table-bordered">
    <tr>
        <th>Status</th>
        <th>Resumo</th>
        <th></th>
        <th>Data de Apresentação</th>
        <th>Hora</th>
        <th>Nota</th>
        <th>Obs.:</th>
        <th>Anexo</th>
        <th></th>
    </tr>
<?php
$tamanho = count($model);
if (3 > 0) {
    for ($i = 0; $i < $tamanho; $i++) {
        ?>
            <tr>
                <td><?= $model[$i]['status'] ?> </td>
                <td><?php echo substr($model[$i]['resumo'], 0, 50) . ' [...] ' ?></td>
                <td>
                    <a href="#" data-toggle='modal' data-target="#myModal<?= $model[$i]['id'] ?>">
                        <samp class="glyphicon glyphicon-eye-open"></samp>
                    </a>
                </td>
                <td><?= $model[$i]['data_apresentacao'] ?> </td>
                <td><?= $model[$i]['horario_apresentacao'] ?> </td>
                <td><?= $model[$i]['nota'] ?> </td>
                <td><?= $model[$i]['observacao_avaliacao'] ?> </td>
                <td><a target="_blank" href="<?= $model[$i]['caminho'] ?>"><samp class="glyphicon glyphicon-eye-open"></samp></a> </td>
                <td><a href="<?= Url::toRoute(["artigo/avaliar", "id" => $model[$i]['id']]) ?>">
                        Avaliar
                    </a>
                </td>

            <div class='modal fade' id=myModal<?= $model[$i]['id'] ?> tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <h4 class='modal-title' id='myModalLabel'>Resumo Completo.</h4>
                        </div>
                        <div class='modal-body'>
                            <p><?= $model[$i]['resumo'] ?> ?</p>    
                        </div>
                        <div class='modal-footer'>

                        </div>
                    </div>
                </div>
            </div>
        </tr>
        <?php
    }
}
?>
</table>

