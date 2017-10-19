<?php 

  	include_once 'conexao.php'; 

    $nome = isset($_POST['nome_ONG']) ? $_POST['nome_ONG'] : '';
    $logo = isset($_POST['logo_ONG']) ? $_POST['logo_ONG'] : '';
    $telong = isset($_POST["tel_ONG"]) ?$_POST["tel_ONG"] : '';
    $cep = isset($_POST["cep_ONG"]) ?$_POST["cep_ONG"] : '';
    $cidade =isset($_POST["cidade_ONG"]) ? $_POST["cidade_ONG"] : '';
    $estado =isset($_POST["estado_ONG"]) ?$_POST["estado_ONG"] : '';
    $rua =isset($_POST["rua_ONG"]) ?$_POST["rua_ONG"] : '';
    $numero =isset($_POST["numero_ONG"]) ?$_POST["numero_ONG"] : '';
    $bairro =isset($_POST["bairro_ONG"]) ?$_POST["bairro_ONG"] : '';
    $complemento =isset($_POST["complemento_ONG"]) ?$_POST["complemento_ONG"] : '';
    $emailong = isset($_POST["email_ONG"]) ?$_POST["email_ONG"] : '';
    $senhaong = isset($_POST["senha_ONG"]) ?sha1 ($_POST["senha_ONG"]) : '';
    $tipo =isset($_POST["tipo_ONG"]) ?$_POST["tipo_ONG"] : '';
    $classi = 2;

        function base64_to_jpeg($base64_string, $arquivo) 
        {
    		$ifp = fopen( "profileONG/".$arquivo, 'wb' ); 

    		if(strpos($base64_string,"base64"))
    			{
        			$data = explode( ',', $base64_string );
        			fwrite( $ifp, base64_decode($data[1]) );
    			}
    		else
    			{
         			fwrite( $ifp, base64_decode($base64_string));
         			$base64_string;
    			}
    		fclose( $ifp ); 
    		return $arquivo; 
    	}

        $endereco = $rua . " " . $numero . " " . $cidade . " " . $estado. " " . $cep;
    
    	function getCoordinates($endereco_arg)
    	{
        	//House Number,Street Name,City, State, Zip, Country
        	$geo_endereco = str_replace(" ", "+", $endereco_arg);
        	$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address={$geo_endereco}";
        	$response = file_get_contents($url);
        	$json = json_decode($response,TRUE); //generate array object from the response from the web
        	return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
    	}

    	$long_lat = getCoordinates($endereco);
    	$coord= explode(",", $long_lat);
    	$longitude=$coord[0] ;
    	$latitude = $coord[1];
   			
   		/* $servidor = "mysql427.umbler.com";
        // $user = "walp_master";
        $senha = "PeVa985534mil";
        $banco = "walp";	*/
   			
		$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $user, $senha, array(PDO::MYSQL_ATTR_INIT_COMMAND =>  'SET NAMES utf8') );
    	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	//$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    	$comando = $conexao->prepare("SELECT * FROM  tab_ong WHERE EMAIL_ONG  = :user");
    	$params = array (":user" => $emailong);
    	$comando->execute($params);
    	$linha = $comando->fetchAll(PDO::FETCH_ASSOC);
    		if(count($linha) > 0)
    			{
    				echo json_encode(false);    
    			}
    		else
    			{
    				try 
    				{   							
    				$comando = $conexao->prepare ("INSERT INTO tab_ong (NOME_ONG,LOGO_ONG,TEL_ONG,CEP_ONG,CIDADE_ONG,ESTADO_ONG,RUA_ONG,NUMERO_ONG,BAIRRO_ONG,COMPLE_ONG,LAT_ONG,LONG_ONG,EMAIL_ONG,SENHA_ONG,TIPO_ONG,CLASSIFICACAO) VALUES (:pnome,:plogo,:ptel,:pcep,:pcidade,:pestado,:prua,:pnumero,:pbairro,:pcomplemento,:plat,:plong,:pemail,:psenha,:ptipo,:pclassi)"); 
    				$params = array(":pnome" => $nome,":plogo"=>$logo,":ptel"=>$telong,":pcep"=>$cep,"pcidade"=>$cidade,"pestado"=>$estado,"prua"=>$rua,"pnumero"=>$numero,"pbairro"=>$bairro,"pcomplemento"=>$complemento,":plat"=>$latitude,":plong"=>$longitude,":pemail" => $emailong,":psenha"=>$senhaong,":ptipo"=>$tipo,":pclassi"=>$classi);

     				$retorno = $comando->execute($params);

     				echo json_encode(true);
     			
     				}
     				catch(Exception $e)
    				{
        			var_dump($e->getMessage());
        			echo json_encode(false);
    				}
    			}
?>