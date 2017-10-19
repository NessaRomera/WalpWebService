<?php
    include_once 'conexao.php';
    
    //$nome = !empty($_POST["lat_ONG"]) ? $_POST["lat_ONG"] : "";
    //$nome = !empty($_POST["long_ONG"]) ? $_POST["long_ONG"] : "";

	$conexao = new PDO("mysql:host=$servidor;dbname=$banco",$user,$senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $comando = $conexao-> prepare("SELECT NOME_ONG,TIPO_ONG FROM  tab_ong");
    $comando->execute();
    $dados = $comando->fetchAll(PDO::FETCH_ASSOC);
    
    $ongs_prox = array();
    
    echo json_encode($ongs_prox);
    
    ?>
    