<?php
    
    include_once 'conexao.php';
    
            $id = $_GET["id_ONG"];
    
            try
            {
	        $conexao = new PDO("mysql:host=$servidor;dbname=$banco",$user,$senha,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $comando = $conexao-> prepare
            ("SELECT 
            NOME_ONG,LOGO_ONG,SOBRE_ONG,EMAIL_ONG,TEL_ONG,TIPO_ONG, CEP_ONG, CIDADE_ONG,ESTADO_ONG,RUA_ONG,NUMERO_ONG,BAIRRO_ONG,COMPLE_ONG,LAT_ONG,LONG_ONG,SITE_ONG 
            FROM  tab_ong WHERE ID_ONG = :id");
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
    