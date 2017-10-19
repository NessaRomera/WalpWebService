<?php
	$idusuario = $_POST["iduser"];
	$idong = $_POST["idONG"];
	$objdoacao = $_POST ["objdoacao"];							//Esses nomes que estão entre colchetes são os nomes das caixas de texto do front.
	$qtddoacao = $_POST ["qtddoacao"];
	$datadoacao = $_POST ["data_doacao"];
  $pontdoacao = $_POST ['pont_doacao'];

	$servidor = "mysql427.umbler.com";
	$user = "walp_master";
	$senha = "PeVa985534mil";
	$banco = "walp";

$conexao = new PDO("mysql:host=$servidor;dbname=$banco",$user,$senha);


	$comando = $conexao -> prepare
	("INSERT INTO tab_doacao
		( ID_USUARIO, ID_ONG, OBJ_DOACAO, QTD_DOACAO, DATA_DOACAO, PONT_DOACAO)
	VALUES

	(:piduser, :pidong, :pobjdoacao, :pqtddoacao, :pdatadoacao, :ppontdoacao)");
	$params = array
	(":piduser" => $idusuario, ":pidong" => $idong,
	":pobjdoacao" => $objdoacao, ":pqtddoacao" => $qtddoacao,
	":pdatadoacao" => $datadoacao, ":ppontdoacao" => $pontdoacao);
	$retorno = $comando->execute($params);

	  echo json_encode($retorno); //variável que o Android vai consumir

?>
