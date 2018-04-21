<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Participante';
$this->params['Participante'][] = $this->title;
?>
<h3>Bem vindo(a) ao sistema SEPE</h3><br/>
<h4>Aqui você fica por dentro de tudo o que acontece no Seminário de Ensino, Pesquisa e Extensão do CERES-UFRN </h4>

<a href="<?=Url::toRoute("usuario/index")?>"> Eventos</a><br/>
<a href="<?=Url::toRoute("usuario/meusdados")?>">Alterar meus dados</a>

<table class="table table-bordered">
    <caption><h3><b>Acontecimentos do Evento: <?php echo $descricao;?></b></h3></caption>
            <tr>
         <th>Descrição</th>
        <th>Tipo</th>
        <th>Evento</th>
        <th>Ministrante(s)</th>
        <th>Local do Acontecimento</th>
        <th>Data Inicio</th>
        <th>Data Fim</th>
        <th>Usuário</th>
        <th></th>
              </tr>
            <?php
            $tamanho = count($model);
            if($tamanho > 0){
                for($i =0; $i<$tamanho; $i++){
                    ?>
                    <tr>
                        <td><?=$model[$i]['descricao'] ?> </td>
                        <td><?=$model[$i]['tipo'] ?> </td>
                        <td><?=$model[$i]['evento'] ?> </td>
                        <td><?=$model[$i]['ministrante'] ?> </td>
                         <td><?=$model[$i]['local_acontecimento'] ?> </td>
                         <td><?=$model[$i]['data_inicio'] ?> </td>
                        <td><?=$model[$i]['data_fim'] ?> </td>
                         <td><?=$model[$i]['usuario'] ?> </td>
                    
                    <td>
                <a href="#" data-toggle='modal' data-target="#myModal<?= $model[$i]['id'] ?>">Sair</a>
            </td>
                    <div class='modal fade' id=myModal<?= $model[$i]['id']?> tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h4 class='modal-title' id='myModalLabel'>Sair deste acontecimento!</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Deseja realmente sair deste acontecimento? <?= $model[$i]['descricao']?> ?</p>    
                                        </div>
                                        <div class='modal-footer'>
                                            <?= Html::beginForm(Url::toRoute("acontecimento/deixaracontecimento"), "POST") ?>
                                                <input type="hidden" name="id_evento" value="<?= $id?>">
                                                <input type="hidden" name="descricao" value="<?= $descricao?>">

                                                <input type="hidden" name="id_inscricao" value="<?= $model[$i]['id_inscricao']?>">
                                                <button type="submit" class="btn btn-primary">Sair</button>
                                            <?= Html::endForm()?>
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
<br/>
<br/>

<table class="table table-bordered">
    <caption><h3><b>Outros Acontecimentos do Evento <?php echo $descricao;?></b></h3></caption>
            <tr>
                     <th>Descrição</th>
        <th>Tipo</th>
        <th>Evento</th>
        <th>Ministrante(s)</th>
        <th>Local do Acontecimento</th>
        <th>Data Inicio</th>
        <th>Data Fim</th>
        <th>Usuário</th>
              </tr>
            <?php
            $tamanho = count($model2);
            $tamanho2=count($model);
            if($tamanho > 0){
                for($i =0; $i<$tamanho; $i++){
                    $ja_me_inscrevi=0;
                    for($j=0;$j<$tamanho2;$j++){
                        if($model[$j]['id']==$model2[$i]['id']){
                            $j=$tamanho2+1;
                            $ja_me_inscrevi=1;
                        }
                    }
                    if($ja_me_inscrevi==0){
                        echo "<tr>";
                        echo"<tds".$model2[$i]['descricao']."</td>";
                       echo "<td>".$model2[$i]['tipo']."</td>";
                         echo " <td>".$model2[$i]['evento'] ."</td>";
                         echo " <td>".$model2[$i]['ministrante'] ." </td>";
                          echo " <td>".$model2[$i]['local_acontecimento']." </td>";
                          echo " <td>".$model2[$i]['data_inicio']." </td>";
                          echo "<td>".$model2[$i]['data_fim'] ."</td>";
                          echo " <td>".$model2[$i]['usuario']." </td>";
                        echo  "<td>".Html::beginForm(Url::toRoute("acontecimento/inscrever"), "POST")."
                               <input type='hidden' name='id_evento' value='". $id."'>
                                                <input type='hidden' name='descricao' value='". $descricao."'>
                                                <input type='hidden' name='id' value='". $model2[$i]['id']."'>
                                                <button type='submit' class='btn btn-primary'>Inscrever-se</button>
                                            ".Html::endForm().".</td></tr>";



                    }
                }
            }
                    ?>
                   
          
                
                
                    </table>
