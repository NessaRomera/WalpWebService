<?php
	$usuario = $_POST['user'];
	$pass = $_POST["senha"];
	$passFunfa = sha1($pass);

$servidor = "mysql427.umbler.com";
$user = "walp_master";
$senha = "PeVa985534mil";
$banco = "walp";

$conexao = new PDO("mysql:host=$servidor;dbname=$banco",$user,$senha);
$comando = $conexao->prepare
("SELECT * FROM  tab_usuario WHERE EMAIL_USUARIO  = :user AND SENHA_USUARIO = :senha 
  UNION 
  SELECT * FROM  tab_ong WHERE EMAIL_ONG  = :user AND SENHA_ONG = :senha ");
$params = array (":user" => $usuario, ":senha" => $passFunfa);
$comando->execute($params);
$linha = $comando->fetchAll(PDO::FETCH_ASSOC);
if(count($linha) > 0)
{
	echo json_encode(true);	
}
else
{
	echo json_encode(false);	
}

?>