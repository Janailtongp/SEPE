<?php

    function F_conect(){
        $servidor = "localhost";    
        $nomebanco = "sepe" ;
        $usuario = "root";
        $senha = "";

        // Criando conexão com o Banco de Dados
        $conn = new mysqli($servidor, $usuario, $senha,$nomebanco);

        // Checando conexão erro
        if ($conn->connect_error)
            {
            //Caso verdadeiro, Mostra o Erro.
            die("Connection failed: " . $conn->connect_error);
        }else{
            // Caso falso, retorna a conexão
            return $conn;
        }
    }  
    
    function Alert($titulo, $corpo, $tipo){
        echo "<div class='alert alert-".$tipo." alert-dismissible fade in' role='alert'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button> <strong>".$titulo."</strong><BR/>".$corpo."</div>";
        
    }
    
    

