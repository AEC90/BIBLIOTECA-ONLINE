
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca Online</title>
    <link type="text/css" rel="stylesheet" href="assets/css/styles.css">
    <script src="/assets/js/script.js"></script>
</head>
<body class="container_body">

    <h3 style="color:#ffbc2c" >REGISTAR LIVRO</h3>
    
  <div class="form_registar">
      <!-- Formulário -->
      <img class="logoic" src="assets/img/logo.png">
    <form  name="registar" method="POST" action="code.php" enctype="multipart/form-data">
      <!-- LIVRO -->
      <label class="subTitle">Dados Do Livro</label>
      <!-- INFORMAÇÕES DO LIVRO -->
      <label>Titulo:</label>
      <input type="hidden" name="codigo" value ="-1" size="40">
      <input type="text" name="titulo" placeholder="Titulo do livro" size="40">
      <label>Ano:</label>
      <input type="text" name="ano" placeholder="Ano de publicação (4 digitos)" size="40">
      <label>Edição:</label>
      <input type="text" name="edicao" placeholder="Edição / Volume" size="40">
      <label>Biblioteca(s):</label>
      <input type="text" name="biblioteca" placeholder="Biblioteca1, biblioteca2" size="40">
      <label>Descri&ccedil;&atilde;o:</label>
      <input type="text" name="descricao" placeholder="descreva o livro" size="40">
      <!-- Info do autor -->
      <label class="subTitle">Dados Do Autor</label>
      <label>Nomes:</label>
      <input type="text" name="nome" placeholder="nome sobrenome" size="40">
      <label>Apelido:</label>
      <input type="text" name="apelido" placeholder="apelido" size="40">
      <!-- Ficheiros -->
      <label class="subTitle">Ficheiros</label>
      <label style="color:#ffbc2c"><strong>LIVRO EM PDF:</strong></label>
      <input type="file" required name="filepdf" value = "Livro">
      <label style="color:#ffbc2c"><strong>CAPA DO LIVRO:</strong></label>
      <input type="file" required name="fileimg" value = "Capa"><br><br>
      <input class="Carregar" type="submit" name="registar" value="Registar"> <!-- botão -->
    </form>
  </div>
</body>
</html>