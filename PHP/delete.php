<?php
    
    include_once 'conexao.php'; 

    $id = $_POST["id_conta"];
    $email = $_POST["email_conta"];
	$pass = $_POST["senha_conta"];
	$passFunfa = sha1($pass);

    $conexao = new PDO("mysql:host=$servidor;dbname=$banco",$user,$senha);
    $comando = $conexao->prepare
    ("
    SELECT CLASSIFICACAO
    FROM tab_usuario 
    WHERE ID_USUARIO = :id AND EMAIL_USUARIO = :email AND SENHA_USUARIO = :senha 
    UNION
    SELECT CLASSIFICACAO
    FROM tab_ong 
    WHERE ID_ONG = :id AND EMAIL_ONG = :email AND SENHA_ONG = :senha 
    ");
    $params = array (":id" => $id, ":email" => $email,":senha" => $passFunfa);
    $comando->execute($params);
    $linha = $comando->fetchAll(PDO::FETCH_ASSOC); 
    
    if($linha > 0)
    {
        var_dump($linha);
        $classi = (int) $linha[0]["CLASSIFICACAO"];
        
        if ($classi == 1)
        {
         $comando = $conexao->prepare
        ("
            DELETE FROM tab_usuario
            WHERE EMAIL_USUARIO = :email AND ID_USUARIO = :id AND SENHA_USUARIO = :senha    
        ");
        $params = array (":id" => $id, ":email" => $email,":senha" => $passFunfa);
        $comando->execute($params);
        echo json_encode(true);
        }
        else if($classi==2)
        {
         $comando = $conexao->prepare
        ("
            DELETE FROM tab_ong
            WHERE EMAIL_ONG = :email AND ID_ONG = :id AND SENHA_ONG = :senha    
        ");
        $params = array (":id" => $id, ":email" => $email,":senha" => $passFunfa);
        $comando->execute($params);
        echo json_encode(true);
        }
    }
    else
    {
    echo json_encode(false); 
    }
    
?>