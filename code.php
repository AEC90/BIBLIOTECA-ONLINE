<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<?php
			include_once("conexao.php");
			
			/* Pasta onde iraõ ficar os ficheiros */
			$_UP['pasta'] = 'files/';

			//Array com a extensões permitidas
			$_UP['extensoesimg'] = array('png', 'jpg', 'jpeg', 'gif');
			$_UP['extensoespdf'] = array('pdf');

			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][2] = 'Não foi feito o upload do arquivo';

			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if(($_FILES['filepdf']['error'] != 0) and ($_FILES['fileimg']['error'] != 0))
			{
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['filepdf']['error']]."<br> ou erro: ".$_UP['erros'][$_FILES['fileimg']['error']]);
				exit; //Para a execução do script
			}

			//Faz a verificação da extensao do arquivo
		 	$extensaopdf = strtolower(substr($_FILES['filepdf']['name'], -3));
			$extensaoimg = strtolower(substr($_FILES['fileimg']['name'], -3));
		 	/* $extensaopdf = strtolower(end(explode('.', $_FILES['filepdf']['name'])));
			$extensaoimg = strtolower(end(explode('.', $_FILES['fileimg']['name']))); */
			if(array_search($extensaopdf, $_UP['extensoespdf']) === false and array_search($extensaoimg, $_UP['extensoesimg']) === false)
			{		
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/biblioteca/registar.php'>
					<script type=\"text/javascript\">
						alert(\"Tente verificar a extesão dos ficheiros **Livro em pdf, capa em jpg ou png**\");
					</script>
				"; exit;
			} 
			/* passando o nome dos ficheiros para as variaveis */
			$pdf = $_FILES['filepdf']['name'];
			$img = $_FILES['fileimg']['name'];
			$nome_finalpdf = md5(time()).'.'.$extensaopdf;
			$nome_finalimg = md5(time()).'.'.$extensaoimg;
			//Verificar se é possivel mover o arquivo para a pasta escolhida
			if((move_uploaded_file($_FILES['filepdf']['tmp_name'],$_UP['pasta'].$nome_finalpdf)) and (move_uploaded_file($_FILES['fileimg']['tmp_name'],$_UP['pasta'].$nome_finalimg)))
			{
					/* passando os dados do formulário para as variáveis */
				$codigo = filter_input (INPUT_POST, 'codigo', FILTER_SANITIZE_NUMBER_INT);
				$titulo = filter_input (INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
				$ano = filter_input (INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
				$edicao = filter_input (INPUT_POST, 'edicao', FILTER_SANITIZE_STRING);
				$biblioteca = filter_input (INPUT_POST, 'biblioteca', FILTER_SANITIZE_STRING);
				$descricao = filter_input (INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
				$nome = filter_input (INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
				$apelido = $_POST['apelido'];
				$dirpdf = "files/$nome_finalpdf";
				$dirimg = "files/$nome_finalimg";

				//verifica se tem codigo
				if($codigo>($k=0)) {

					 

				$registro = "UPDATE livro SET titulo='$titulo', ano='$ano', edicao='$edicao', bibliotecas='$biblioteca', descricao='$descricao',
				nomes='$nome', apelido='$apelido', pdf='$dirpdf', img='$dirimg' WHERE codigo='$codigo'";
				$resultado = mysqli_query($conn,$registro);	
				
				/* if(mysql_affected_rows($conn)){
				}else{ */
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/biblioteca/'>
						<script type=\"text/javascript\">
							alert(\"Actualização efectuado com sucesso\");
						</script>
					"; 	
					
				/* 	echo "
							<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/biblioteca/'>
							<script type=\"text/javascript\">
								alert(\"Falha na Actualização\");
							</script>
						";
				} */
										
				} else{

					//Registro efectuado com sucesso
					$registro = "insert into livro(titulo, ano, edicao, bibliotecas, descricao, nomes, apelido, pdf, img)
					values('$titulo','$ano','$edicao','$biblioteca','$descricao','$nome','$apelido','$dirpdf','$dirimg')";
					$resultado = mysqli_query($conn,$registro);
					 
				 	echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/biblioteca/registar.php'>
						<script type=\"text/javascript\">
							alert(\"Registro efectuado com sucesso\");
						</script>
					";  	

				}
				
				
			}else{
				//Falha no registro
			 	echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/biblioteca/registar.php'>
					<script type=\"text/javascript\">
						alert(\"Falha no registro, os ficheiros podem ser grandes, tente muda-los.\");
					</script>
				"; 
			}
		
	
			
			
		/* 	$dir="ficheiros/";
				if(isset($_FILES['filepdf']) and isset($_FILES['fileimg'])){
				move_uploaded_file($_FILES['filepdf']['tmp_name'],$dir);
				move_uploaded_file($_FILES['fileimg']['tmp_name'],$dir);
				
				$titulo = filter_input (INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
				$ano = filter_input (INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
				$edicao = filter_input (INPUT_POST, 'edicao', FILTER_SANITIZE_STRING);
				$biblioteca = filter_input (INPUT_POST, 'biblioteca', FILTER_SANITIZE_STRING);
				$descricao = filter_input (INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
				$nome = filter_input (INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
				$apelido = $_POST['apelido'];
				
				

				$registro = "insert into livro(titulo, ano, edicao, bibliotecas, descricao, nomes, apelido, pdf, img) 
				values('$titulo','$ano','$edicao','$biblioteca','$descricao','$nome','$apelido','$pdf','$img')";
				$resultado = mysqli_query($conn,$registro);

				if(mysqli_insert_id($conn)){
					$_SESSION['msg'] = "<p style = 'color: green;'>Livro registado com sucesso</p>";
					header("Location: registar.php");
				}else{
					$_SESSION['msg'] = "<p style = 'color: red;'>Falha no carregamento!!</p>";
					header("Location: registar.php"); 
				}
			}
				
				 */
	?>	
</body>
</html>
