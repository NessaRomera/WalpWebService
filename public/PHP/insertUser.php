<?php 

    include_once 'conexao.php'; 

 	$nome = isset($_POST["nome_user"]) ? $_POST["nome_user"] : "";
	$sobrenome = isset($_POST["sobrenome_user"]) ? $_POST["sobrenome_user"] : "";
	$cel = isset($_POST["cel_user"]) ? $_POST["cel_user"] : "";
	$email = isset($_POST["email_user"]) ? $_POST["email_user"] : "";
    $pass = isset($_POST["senha_user"]) ? sha1($_POST["senha_user"]) : "";
    $tkfacebook = isset($_POST["tkfacebook_user"]) ? $_POST["tkfacebook_user"] : "";
    $arquivo = isset($_POST["img_user"]) ? $_POST["img_user"] : "";
    $classi = 1;
    
	/*$servidor = "mysql427.umbler.com";
	$user = "walp_master";
	$senha = "PeVa985534mil";
	$banco = "walp";*/
	
    function base64_to_jpeg($base64_string, $arquivo) 
    {
        $ifp = fopen( "profileUser/".$arquivo, 'wb' ); 
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

        $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $user, $senha, array(PDO::MYSQL_ATTR_INIT_COMMAND =>  'SET NAMES utf8') );
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $comando = $conexao->prepare("SELECT * FROM  tab_usuario WHERE EMAIL_USUARIO  = :user");
        $params = array (":user" => $email);
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
            $arquivo = base64_to_jpeg($arquivo,"img".time().".jpg");
	        $comando = $conexao -> prepare ("INSERT INTO tab_usuario (NOME_USUARIO,SOBRENOME_USUARIO,CEL_USUARIO, EMAIL_USUARIO ,SENHA_USUARIO,TKFACEBOOK_USUARIO,IMG_USER,CLASSIFICACAO) VALUES (:pnome, :psobre,:pcel, :pemail, :psenha, :ptk, :pimg, :pclassi)");
                $params = array(":pnome" => $nome, ":psobre" => $sobrenome,":pcel"=>$cel,":pemail" => $email, ":psenha" => $pass, ":ptk" => $tkfacebook, ":pimg" => $arquivo, ":pclassi" => $classi);
    $retorno = $comando->execute($params);
	
	 //var_dump($params);
	 
    echo json_encode(true);
        }
    catch(Exception $e){
       // var_dump($e->getMessage());
        echo json_encode(false);
        }
    }
?>
