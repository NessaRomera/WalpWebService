<?php 

    include_once 'conexao.php'; 
	
	$id = $_POST['id_ONG'];
	
    $nome = $_POST['nome_ONG'];
    $logo = $_POST['logo_ONG'];
    $telong =$_POST["tel_ONG"];
    $cep = $_POST["cep_ONG"];
    $cidade =$_POST["cidade_ONG"]; 
    $estado =$_POST["estado_ONG"];
    $rua =$_POST["rua_ONG"];
    $numero =$_POST["numero_ONG"];
    $bairro =$_POST["bairro_ONG"];
    $complemento =$_POST["complemento_ONG"];
    $emailong = $_POST["email_ONG"];
    $sobre = $_POST['sobre_ONG'];
    $horarece = $_POST["horarece_ONG"];
    $horaence = $_POST["horaence_ONG"];
    $site = $_POST['site_ONG']; 
    
    
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
        	//print_r($json);
        	return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
    	}
    	
    	

    	$long_lat = getCoordinates($endereco);
    	$coord= explode(",", $long_lat);
    	$longitude=$coord[0] ;
    	$latitude = $coord[1];
    
    
    
    try 
    {
        $conexao = new PDO("mysql:host=$servidor;dbname=$banco",$user,$senha,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
         $imagem = "http://walpweb.com.br/PHP/profileONG/" . base64_to_jpeg($logo,"img".utf8_encode($nome).time().".jpg");    
        $comando = $conexao -> prepare ("
        UPDATE tab_ong
        SET NOME_ONG = :pnome,LOGO_ONG = :plogo,TEL_ONG = :ptel,CEP_ONG = :pcep,CIDADE_ONG = :pcidade,ESTADO_ONG = :pestado,RUA_ONG = :prua,NUMERO_ONG = :pnumero,BAIRRO_ONG = :pbairro,COMPLE_ONG = :pcomple,LAT_ONG = :plat,LONG_ONG = :plong, EMAIL_ONG = :pemail,SOBRE_ONG = :psobre,HORARECE = :hr,HORAENCE = :he,SITE_ONG = :psite	
        WHERE ID_ONG = :id");
        $params = array(":id" => $id, ":pnome" => $nome,":plogo" => $imagem,":ptel" => $telong,":pcep" => $cep,":pcidade" => $cidade,":pestado" => $estado,":prua" => $rua,":pnumero" => $numero,":pbairro" => $bairro,":pcomple" => $complemento,":plat" => $latitude,":plong" => $longitude,":pemail" => $emailong,":psobre" => $sobre,":hr" => $horarece,":he" => $horaence,":psite" => $site);
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