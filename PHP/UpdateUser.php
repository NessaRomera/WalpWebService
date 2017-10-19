<?php 

    include_once 'conexao.php'; 
	
	$id = $_POST['id_user'];
	
    $nome = $_POST['nome_user'];
    $sobrenome = $_POST['sobrenome_user'];
    $cel = $_POST['cel_user'];
    $email = $_POST["email_user"];
    $img = $_POST['img_user']; 
    
    try 
    {
        $conexao = new PDO("mysql:host=$servidor;dbname=$banco",$user,$senha,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $comando = $conexao -> prepare ("
        UPDATE tab_usuario
        SET NOME_USUARIO = :pnome,SOBRENOME_USUARIO = :psobre,CEL_USUARIO = :pcel,EMAIL_USUARIO = :pemail,IMG_USER = :pimg	
        WHERE ID_USUARIO = :id");
        $params = array(":id" => $id, ":pnome" => $nome,":psobre" => $sobrenome,":pcel" => $cel,":pemail" => $email,":pimg" => $img);
        $retorno = $comando->execute($params);
	
	    var_dump($retorno);
	 
            echo json_encode(true);
            }
            
            catch(Exception $e)
            {
            var_dump($e->getMessage());
            echo json_encode(false);
            }
    
?>