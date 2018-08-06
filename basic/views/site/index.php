<?php
/* @var $this yii\web\View */

$this->title = 'UFRN/CERES - SEPE';
?>
<div class="site-index">

    <!DOCTYPE html>
<html lang="en">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Custom styles for this template -->
    <link href="./css/heroic-features.css" rel="stylesheet">

   

    <!-- Page Content -->
    <div class="container">
        <?php 
        $logo ="./imagens/capaPadrao.png";
        $titulo ="SEPE Padrão";
        $descricao ="Descrição padrão";
        
        if(isset($sql)){
            $logo = $sql[0]['imagem'];
            $titulo = $sql[0]['titulo'];
            $descricao = $sql[0]['descricao'];
        }
        
        
        ?>
      <!-- Jumbotron Header -->
      <header class="jumbotron">
          <img src="<?php echo $logo;?>" alt="Imagem de página não encontrada" width="330" height="202" />
          <h4 class="display-4"><?php echo $titulo;?></h4>
          <p class="lead"><?php echo $descricao;?></p>
      </header>
    
      
      
      <!-- Page Features -->
      <div class="row text-center ajj">

        <div class="col-lg-3 col-md-6 mb-4">
             <a href="#" class="btn btn-primary">Lista de publicações</a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
           <a href="#" class="btn btn-primary">Programação do evento</a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
           <a href="#" class="btn btn-primary">Entre em contato</a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
   
              <a href="#" class="btn btn-primary">Participar</a>
          
        </div>

      </div>
      <!-- /.row -->
      
      
      
      <!-- Page Features -->
      <div class="row text-center">

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Notícia 1</h4>
              <p class="card-text">
              O evento contará com a participação de grandes pesquisadores da área de Informática.
              </p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Ver matéria</a>
            </div>
          </div>
        </div>

         <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Notícia 2</h4>
              <p class="card-text">
              O evento contará com a participação de grandes pesquisadores da área de Informática.
              </p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Ver matéria</a>
            </div>
          </div>
        </div>
           <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Notícia 3</h4>
              <p class="card-text">
              O evento contará com a participação de grandes pesquisadores da área de Informática.
              </p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Ver matéria</a>
            </div>
          </div>
        </div>
           <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Notícia 4</h4>
              <p class="card-text">
              O evento contará com a participação de grandes pesquisadores da área de Informática.
              </p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Ver matéria</a>
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->     
      
      <div class="separador">
         <h4 class="card-title"> Downloads</h4>
      </div>
      <!-- Page Features -->
      <div class="row text-center ajj">

        <div class="col-lg-2">
            <a href="#" class="btn btn-default"><img src="./imagens/file.png">
                <br/>Modelo de Artigo
            </a>
        </div>
          <div class="col-lg-2">
            <a href="#" class="btn btn-default"><img src="./imagens/file.png">
                <br/>Modelo de Banner
            </a>
        </div>
          <div class="col-lg-2">
             <a href="#" class="btn btn-default"><img src="./imagens/file.png">
                <br/>Termo do evento
            </a>
        </div>
           <div class="col-lg-2">
             <a href="#" class="btn btn-default"><img src="./imagens/file.png">
                <br/>Regras ABNT
            </a>
        </div>
          <div class="col-lg-2">
             <a href="#" class="btn btn-default"><img src="./imagens/file.png">
                <br/>Artigo em Latec
            </a>
        </div>
          <div class="col-lg-2">
             <a href="#" class="btn btn-default"><img src="./imagens/file.png">
                <br/>Modelo de resumo
            </a>
        </div>
          
        

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->


    <!-- Bootstrap core JavaScript -->
<!--    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->


    
</div>
