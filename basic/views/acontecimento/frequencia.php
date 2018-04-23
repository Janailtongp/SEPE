
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>


<table class="table table-bordered">
    <caption><h3><b>Lista de Frequência do Acontecimento:<?php echo $acontecimento->descricao;?> do evento:<?php echo $evento->descricao;?></b></h3></caption>
            <tr>
                    <th>Participante</th>
                    <th>Situação</th>
                    <th></th>
                  

              </tr>
            <?php
            $tamanho = count($model);
            if($tamanho > 0){
                for($i =0; $i<$tamanho; $i++){
                    ?>
                    <tr>
                        <td><?=$model[$i]['usuario'] ?> </td>
                        <?php 
                           foreach ($frequencias as $f){
                               if($f->id_participante==$model[$i]['id']){
                                   echo "<td>".$f->status."</td>";
                                   ?>
                        <td><a href="<?= Url::toRoute(["acontecimento/alterarfrequencia","id"=>$f->id,"id_evento"=>$evento->id, "id_acontecimento"=>$acontecimento->id])?>">
                        <button  class="btn btn-primary">Alterar Status</button>

                            </a></td>
                        <?php
                               }
                           }
                        ?>                       
                       

                        
                  
         
                    
            </tr>
            <?php
                }
            }    
            ?>
        </table>