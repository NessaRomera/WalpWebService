<?php
	 echo $necessidade = $_POST["txtNecessidade"];

	 $servidor = "mysql427.umbler.com";
	 $user = "walp_master";
	 $senha = "PeVa985534mil";
	 $banco = "walp";

  $conexao = new PDO("mysql:host=$servidor;dbname=$banco",$user,$senha);


	$comando = $conexao -> prepare ("INSERT INTO tab_necessidade (NECESSIDADE)
	VALUES (:pnece)");
	$params = array(":pnece" => $necessidade);
	$retorno = $comando->execute($params);

	  echo json_encode($retorno); //variável que o Android vai consumir
		print_r($comando ->errorInfo());
?>
