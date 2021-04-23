
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca Online</title>
    <link type="text/css" rel="stylesheet" href="assets/css/styles.css?v=<?php echo time();?>">
    <script src="/assets/js/script.js"></script>
</head>
<?php
  include_once("conexao.php");//conexão com base de dados 
  $codigo = filter_input (INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  $titulo = filter_input (INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
	$ano = filter_input (INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
	$edicao = filter_input (INPUT_POST, 'edicao', FILTER_SANITIZE_STRING);
	$biblioteca = filter_input (INPUT_POST, 'bibliotecas', FILTER_SANITIZE_STRING);
	$descricao = filter_input (INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
	$nome = filter_input (INPUT_POST, 'nomes', FILTER_SANITIZE_STRING);
  $apelido = $_POST['apelido'];
?>

  <body class="container_body">
  
      <h3 style="color:#ffbc2c" >EDITAR LIVRO</h3>
      
    <div class="form_registar">
        <!-- Formulário -->
        <img class="logoic" src="assets/img/logo.png">
      <form  name="registar" method="POST" action="code.php" enctype="multipart/form-data">
        <!-- LIVRO -->
        <label class="subTitle">Dados Do Livro</label>
        <!-- INFORMAÇÕES DO LIVRO -->
        <label>Titulo:</label>
        <input type="hidden" name="codigo" value ="<?php echo $codigo ?>">
        <input type="text" name="titulo" value ="<?php echo $titulo ?>" size="40">
        <label>Ano:</label>
        <input type="text" name="ano" value ="<?php echo $ano ?>" size="40">
        <label>Edição:</label>
        <input type="text" name="edicao" value ="<?php echo $edicao ?>" size="40">
        <label>Biblioteca(s):</label>
        <input type="text" name="biblioteca" value ="<?php echo $biblioteca ?>" size="40">
        <label>Descri&ccedil;&atilde;o:</label>
        <input type="text" name="descricao" value ="<?php echo $descricao ?>" size="40">
        <!-- Info do autor -->
        <label class="subTitle">Dados Do Autor</label>
        <label>Nomes:</label>
        <input type="text" name="nome" value ="<?php echo $nome ?>" size="40">
        <label>Apelido:</label>
        <input type="text" name="apelido" value ="<?php echo $apelido ?>" size="40">
        <!-- Ficheiros -->
        <label class="subTitle">Ficheiros</label>
        <label style="color:#ffbc2c"><strong>LIVRO EM PDF:</strong></label>
        <input type="file" required name="filepdf" value = "Livro">
        <label style="color:#ffbc2c"><strong>CAPA DO LIVRO:</strong></label>
        <input type="file" required name="fileimg" value = "Capa"><br><br>
        <input class="Carregar" type="submit" name="registar" value="Editar"> <!-- botão -->
      </form>
    </div>
  </body>



</html>