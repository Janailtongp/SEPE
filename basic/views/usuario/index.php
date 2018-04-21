<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Participante';
$this->params['Participante'][] = $this->title;
?>
<h3>Bem vindo(a) ao sistema SEPE</h3><br/>
<h4>Aqui você fica por dentro de tudo o que acontece no Seminário de Ensino, Pesquisa e Extensão do CERES-UFRN </h4>

<a href="<?=Url::toRoute("usuario/index")?>">Eventos Abertos</a><br/>
<a href="<?=Url::toRoute("usuario/meusdados")?>">Alterar meus dados</a>

<table class="table table-bordered">
    <caption><h3><b>Minhas Inscrições</b></h3></caption>
            <tr>
                    <th>Local</th>
                    <th>Descrição</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th></th>
                     <th></th>

              </tr>
            <?php
            $tamanho = count($model);
            if($tamanho > 0){
                for($i =0; $i<$tamanho; $i++){
                    ?>
                    <tr>
                        <td><?=$model[$i]['local_evento'] ?> </td>
                        <td><?=$model[$i]['descricao'] ?> </td>
                        <td><?=$model[$i]['data_inicio'] ?> </td>
                        <td><?=$model[$i]['data_fim'] ?> </td>
                    <td>
                <a href="#" data-toggle='modal' data-target="#myModal<?= $model[$i]['id'] ?>">Sair</a>
            </td>
             <td><?= Html::beginForm(Url::toRoute("usuario/indexacontecimento"), "GET") ?>
                                                <input type="hidden" name="id" value="<?= $model[$i]['id']?>">
                                               <input type="hidden" name="descricao" value="<?= $model[$i]['descricao']?>">

                                                <button type="submit" class="btn btn-primary">Acontecimentos</button>
                                            <?= Html::endForm()?></td>
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
                                            <?= Html::beginForm(Url::toRoute("evento/deixarevento"), "POST") ?>
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
    <caption><h3><b>Outros Eventos</b></h3></caption>
            <tr>
                    <th>Local</th>
                    <th>Descrição</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th></th>
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
                        echo "<td>".$model2[$i]['local_evento']."</td>";
                        echo "<td>".$model2[$i]['descricao']."</td>";
                        echo "<td>".$model2[$i]['data_inicio']."</td>";
                        echo "<td>".$model2[$i]['data_fim']."</td>";
                        echo  "<td>".Html::beginForm(Url::toRoute("evento/inscrever"), "POST")."
                                                <input type='hidden' name='id' value='". $model2[$i]['id']."'>
                                                <button type='submit' class='btn btn-primary'>Inscrever-se</button>
                                            ".Html::endForm().".</td></tr>";



                    }
                }
            }
                    ?>
                   
          
                
                
                    </table>
<table class="table table-bordered">
    <caption><h3><b>Minhas Propostas</b></h3></caption>
            <tr>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th></th>
                    <th></th>
              </tr>
            <?php
            $tamanho = count($model3);
            if($tamanho > 0){
                for($i =0; $i<$tamanho; $i++){
                   
                        echo "<tr>";
                        echo "<td>".$model3[$i]['descricao']."</td>";
                        echo "<td>".$model3[$i]['tipo']."</td>";
                        echo "<td>".$model3[$i]['status']."</td>";
                        



                    
                    ?>
                <td><a href="<?= Url::toRoute(["propostas/editar","id"=>$model3[$i]['id'], "descricao"=>$model3[$i]['descricao']])?>"><i class="
glyphicon glyphicon-cog"></i></a>
                            <a href="#" data-toggle='modal' data-target="#proposta<?= $model3[$i]['id'] ?>"><i class="glyphicon glyphicon-trash"></i></a>

            </td>
         

           
            
                    <div class='modal fade' id=proposta<?= $model3[$i]['id']?> tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h4 class='modal-title' id='myModalLabel'>Excluir registro!</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Deseja realmente excluir o registro desta proposta: <?= $model3[$i]['descricao']?> <?= $model3[$i]['tipo']?> ?</p>    
                                        </div>
                                        <div class='modal-footer'>
                                            <?= Html::beginForm(Url::toRoute("propostas/delete"), "POST") ?>
                                                <input type="hidden" name="id" value="<?= $model3[$i]['id']?>">
                                                <button type="submit" class="btn btn-primary">Excluir</button>
                                            <?= Html::endForm()?>
                                        </div>
                                    </div>
                                </div>
                    </div>
              <?php
            }
            }
            
                    ?>
                   
          
                
                 <tr><td><a href="<?= Url::toRoute("propostas/cadastrar") ?>">Adicionar uma nova Proposta</a><td></td><td></td><td></td>
                </tr>
                    </table>
