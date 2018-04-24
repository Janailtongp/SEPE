
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<table class="table table-bordered" id="conteudo">
    <caption><h3><b>Lista de frequência do acontecimento >> <?php echo $acontecimento->descricao;?> >> <?php echo $evento->descricao;?></b></h3></caption>
            <tr>
                    <th>CPF: </th>
                    <th>NOME:</th>
                    <th>ASSINATURA:</th>
                  

              </tr>
            <?php
            $tamanho = count($model);
            if($tamanho > 0){
                for($i =0; $i<$tamanho; $i++){
                    ?>
                    <tr>
                        <td class="cpf"><?=$model[$i]['cpf']?></td><br/>
                        <td class="nome"><?=$model[$i]['usuario'].":" ?> </td>
                        <td class="linha">___________________________________________________</td>
                               }
                           }
                        ?>                       
                       

                        
                  
         
                    
            </tr>
            <?php
                }
            }    
            ?>
        </table>
<h4 id="rodape">Lista gerada atrás do Sistema SEPE</h4>

<style>
    #rodape {
	position: absolute;
	bottom: 0;
	}
        .cpf{
            width: 15%;
        }
        .nome{
            width: 40%;
        }
        .linha{
            width: 45%;
        }
        #conteudo{
            width: 100%;
        }
        tr{
            margin-bottom: 100px;
        }
</style>

