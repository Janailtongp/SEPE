



<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;

?>
    <h1>Relatório dos Participantes do Evento:<?php echo $evento->descricao;?> </h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Acontecimentos</th>
            <?php foreach ($acontecimentos as $row){
                echo "<th>".$row->descricao."</th>";
                
            } ?>
            <th>Porcentagem de Participação no Evento</th>
        </tr>
    </thead>
    <tbody>
          <?php
            // cada usuario
             $n_acontecimento=count($acontecimentos);
             foreach ($usuarios as $row){
                              $n_participacoes=0;

                echo "<tr><td>".$row->nome."</td>";
                //cada acontecimento
                $id_usuario=$row->id;
                $tem_inscricao=false;
                
                foreach ($acontecimentos as $row1){
                    $id_acontecimento=$row1->id;
                    // cada inscricao
                    $achou_inscricao=false;
                    $achou_frequencia=false;
                    foreach($inscricoes as $row2){
                        // tem inscricao
                        
                        if(($row2->id_participante==$id_usuario )&&($row2->id_acontecimento==$id_acontecimento)){
                            // verificar se tem frequencia
                            $achou_inscricao=true;
                            foreach ($frequencias as $row3){
                                if(($row3->id_participante==$id_usuario )&&($row3->id_acontecimento==$id_acontecimento)){
                                    // verifica o status
                                    $achou_frequencia=true;
                                    if(strcmp($row3->status,"Presente")==0){
                                        $n_participacoes++;
                                        echo "<td><i class='glyphicon glyphicon-ok-circle sucess'></i></td>";

                                    }else{
                                                                            echo "<td></td>";

                                    }
                                }else{
 
                                }
                            }
                        }else{
                        }
                    }
                      if(($achou_inscricao==false)||($achou_frequencia==false)){
                    echo "<td></td>";
                }
                }
              
                $porcentagem= ($n_participacoes/$n_acontecimento) *100;
                echo "<td>".$porcentagem." %</td>";
                echo "</tr>";
            } ?> 
    </tbody>
</table>
