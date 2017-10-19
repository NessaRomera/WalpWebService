<?php 

    include_once 'conexao.php'; 

 	$id_ong = isset($_POST["id_ong"]) ? $_POST["id_ong"] : "";
	$necessidade = isset($_POST["necessidade"]) ? $_POST["necessidade"] : "";
	$descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
	$tipo = isset($_POST["tipo_nece"]) ? $_POST["tipo_nece"] : "";

    $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $user, $senha, array(PDO::MYSQL_ATTR_INIT_COMMAND =>  'SET NAMES utf8') );
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);        
            
    try 
        {
        $comando = $conexao -> prepare ("INSERT INTO tab_necessidade (ID_ONG,NECESSIDADE, DESCRICAO, TIPO_NECE) VALUES (:id_ong, :nece, :descricao, :tipo)");
        $params = array(":id_ong" => $id_ong, ":nece" => $necessidade, ":descricao" => $descricao, ":tipo" => $tipo);
        $retorno = $comando->execute($params);
        echo json_encode(true);
            }
            
    catch(Exception $e)
            {
                echo json_encode(false);
            }
    
?>
