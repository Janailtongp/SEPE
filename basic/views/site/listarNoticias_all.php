<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<a href="<?= Url::toRoute("site/index") ?>">Página principal</a>


<h3>Todas as Notícias</h3>

<table class="table table-striped table-condensed table-bordered">
    <tr>
        <th>Título</th>
        <th>Resumo da postagem</th>
        <th></th>
    </tr>
    <?php foreach ($model as $row): ?>
        <tr>
            <td><?= $row->titulo ?></td>
            <td><?= substr(strip_tags($row->corpo), 0, 100)." [...]" ?></td>
            <td> <a href="<?= Url::toRoute(["site/exibirnoticia","id_noticia"=>$row->id])?>">Ver</a></td>
        </tr>
<?php endforeach; ?>
</table>

<?=
LinkPager::widget([
    "pagination" => $pages,
])
?>