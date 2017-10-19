<?php
    
    include_once 'conexao.php';
    
            $id = $_GET["id_user"];
    
            try
            {
	        $conexao = new PDO("mysql:host=$servidor;dbname=$banco",$user,$senha,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $comando = $conexao-> prepare
            ("SELECT 
            NOME_USUARIO,SOBRENOME_USUARIO,CEL_USUARIO,EMAIL_USUARIO,IMG_USER
            FROM  tab_usuario WHERE ID_USUARIO = :id");
            $params = array(":id"=>$id);
            $comando->execute($params);
            $dados = $comando->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($dados);
            }
            catch(Exception $e)
    		{
        	var_dump($e->getMessage());
        	echo json_encode(false);
    		}
 

    
    ?>
    