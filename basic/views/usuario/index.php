<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Participante';
$this->params['Participante'][] = $this->title;
?>
<h3>Bem vindo(a) ao sistema SEPE</h3><br/>
<h4>Aqui você fica por dentro de tudo o que acontece no Seminário de Ensino, Pesquisa e Extensão do CERES-UFRN </h4>

<a href="<?=Url::toRoute("evento/index")?>">Eventos Abertos</a><br/>
<a href="<?=Url::toRoute("usuario/meusdados")?>">Alterar meus dados</a>

<table class="table table-bordered">
    <caption><h3><b>Meus eventos</b></h3></caption>
            <tr>
                    <th>ID</th>
                    <th>Local</th>
                    <th>Descrição</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th></th>
              </tr>
            <?php
            $tamanho = count($model);
            if($tamanho > 0){
                for($i =0; $i<$tamanho; $i++){
                    ?>
                    <tr>
                        <td><?=$model[$i]['id_evento'] ?> </td>
                        <td><?=$model[$i]['local_evento'] ?> </td>
                        <td><?=$model[$i]['descricao'] ?> </td>
                        <td><?=$model[$i]['data_inicio'] ?> </td>
                        <td><?=$model[$i]['data_fim'] ?> </td>
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
                                            <?= Html::beginForm(Url::toRoute("evento/deixarevento"), "POST") ?>
                                                <input type="hidden" name="id_inscricao" value="<?= $model[$i]['id']?>">
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
                    <th>ID</th>
                    <th>Local</th>
                    <th>Descrição</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th></th>
              </tr>
            <?php
            $tamanho = count($model2);
            if($tamanho > 0){
                for($i =0; $i<$tamanho; $i++){
                    ?>
                    <tr>
                        <td><?=$model2[$i]['id'] ?> </td>
                        <td><?=$model2[$i]['local_evento'] ?> </td>
                        <td><?=$model2[$i]['descricao'] ?> </td>
                        <td><?=$model2[$i]['data_inicio'] ?> </td>
                        <td><?=$model2[$i]['data_fim'] ?> </td>
                    <td>
                <a href="#" data-toggle='modal' data-target="#myModal<?= $model2[$i]['id'] ?>">Sair</a>
            </td>
                    <div class='modal fade' id=myModal<?= $model2[$i]['id']?> tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h4 class='modal-title' id='myModalLabel'>Sair deste acontecimento!</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Deseja realmente sair deste acontecimento? <?= $model2[$i]['descricao']?> ?</p>    
                                        </div>
                                        <div class='modal-footer'>
                                            <?= Html::beginForm(Url::toRoute(""), "POST") ?>
                                                <input type="hidden" name="id_usuario" value="<?= $model2[$i]['id']?>">
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
