<?php
use yii\helpers\Url;
if(isset($sql)){
   ?> 
    
<h1><?= $sql[0]['titulo']?></h1>
<p><?= $sql[0]['corpo']?></p>
<p>Publicado por <b><i><?= $sql[0]['autor']?> </i></b> em <b><i><?= $sql[0]['data_noticia']?></b></i></p>
<a href="<?= Url::toRoute(["site/listarnoticiasall"])?>">Outras notícias</a>
<?php    
}
