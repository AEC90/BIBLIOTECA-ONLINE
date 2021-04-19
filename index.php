<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=<?php echo time();?>">
    <script src="assets/js/script.js"></script>
</head>
<body>
  <div class="container">
    <div id="header" title="Biblioteca Online">
             Biblioteca online
    </div>
    <!-- Botão para acessar regisatar -->
    <div id="menu"> 
      <a href="registar.php"><button class="registar_livro">Registar Livro</button></a>
    </div>

    <!-- Pequeno form para pesquisa -->
    <div id = "contents">
      <img class="logo" src="assets/img/logo.png">
      <form class="form_pesquisa" name="pesqsuisa" action="index.php" method="POST">
        <h4>PESQUISAR</h4>
        <br>
        <input type="search" name="titulo" placeholder="Digite o titulo do livro" size="70">
        <br><br>
        <input type="search" name="nome" placeholder="ou autor (apelido)" size="70">
        <br><br>
        <input name="pesquisar" type="submit"  value="clicksearach" id="pesquisar">
      </form>
      <br>
                   
        <h1 class="titulo_publicacoes">LIVROS DISPONÍVEIS</h1>
        <div class="publicacoes">
          <div class="container_livro">
              
                <?php
                include("conexao.php");
                ?>
                <?php
                 $pesquisar = filter_input (INPUT_POST, 'pesquisar', FILTER_SANITIZE_STRING);
                  /* $pesquisar = $_POST['pesquisar']; */
                  if($pesquisar=="clicksearach"){
                    
                    $titulo = filter_input (INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
                    $nome = filter_input (INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                    if($titulo!=="" and $titulo!==0)
                    {
                    $sql = "select * from livro where titulo like '%$titulo%'";
                    $resultado = mysqli_query($conn,$sql);
                    
                    $total = mysqli_num_rows($resultado);

                        if($total === 0)
                        {
                          echo "
                          <script type=\"text/javascript\">
                            alert(\"SEM RESULTADO\");
                          </script>
                        ";

                        } else{

                          while ($registro = mysqli_fetch_array($resultado)){ 
                           $codigo = $registro['codigo'];
                               $pdf = $registro['pdf'];
                               $img = $registro['img'];
                                 echo '<img id="capa" src='.$img.'>';
                                 echo "<h2>".$registro['titulo']."</h2>"; 
                                 echo "<h5>".$registro['apelido'].", ".$registro['nomes']."</h5>";
                                 echo "<b>Ano:</b> ".$registro['ano']."</i><br>"; 
                                 echo "<b>Edição:</b> ".$registro['edicao']."<br>";
                                 echo "<b>Bibliotecas disponiveis:</b><br>".$registro['bibliotecas']."<br>";
                                 echo "<p><b>Descrição:</b> <br>".$registro['descricao']."</p><br>";?>
     
                           <div class="bt">
                             <a href="<?php echo $pdf ?>"><button id="ler_livro">Ler Livro</button></a>
                             <form id="form_editar" action="editar.php" method="POST">
                               <input type = "hidden" name="id" value="<?php echo $codigo  ?>">
                               <input type="hidden" name="titulo" value="<?php echo $registro['titulo']  ?>">
                               <input type="hidden" name="ano" value="<?php echo $registro['ano']  ?>">
                               <input type="hidden" name="edicao" value="<?php echo $registro['edicao']  ?>">
                               <input type="hidden" name="bibliotecas" value="<?php echo $registro['bibliotecas']  ?>">
                               <input type="hidden" name="descricao" value="<?php echo $registro['descricao']  ?>">
                               
                               <input type="hidden" name="nomes" value="<?php echo $registro['nomes']  ?>">
                               <input type="hidden" name="apelido" value="<?php echo $registro['apelido']  ?>">
     
                               <!-- <input type="hidden" name="img" value="<?php echo $img  ?>">
                               <input type="hidden" name="pdf" value="<?php echo $pdf  ?>"> -->
                               <input type = "submit" name="editar" value="Editar Livro" id="editar">                          
                             </form>
                          </div>
                                 <!-- echo '<a id="ler_livro" href ="'.$pdf.'">Ler livro</a><br>'; -->
                               <?php
                                 echo "<br>"  ;
                                 echo "<hr>";                
                                }


                        }
                      
                     
                    }else /* Do titulo */
                    
                    {  

                      if($nome!=="" and $nome!==0){

                        $sql1 = "select * from livro where apelido like '%$nome%'";
                        $resultado = mysqli_query($conn,$sql1);
                        /* testa se trouxe resultado */
                        $total = mysqli_num_rows($resultado); 
                        if($total === 0)
                        {
                          echo "
                          <script type=\"text/javascript\">
                            alert(\"SEM RESULTADO\");
                          </script>
                        ";

                        } else{
                          
                          while ($registro = mysqli_fetch_array($resultado)){ 
                           $codigo = $registro['codigo'];
                           $pdf = $registro['pdf'];
                           $img = $registro['img'];
                             echo '<img id="capa" src='.$img.'>';
                             echo "<h2>".$registro['titulo']."</h2>"; 
                             echo "<h5>".$registro['apelido'].", ".$registro['nomes']."</h5>";
                             echo "<b>Ano:</b> ".$registro['ano']."</i><br>"; 
                             echo "<b>Edição:</b> ".$registro['edicao']."<br>";
                             echo "<b>Bibliotecas disponiveis:</b><br>".$registro['bibliotecas']."<br>";
                             echo "<p><b>Descrição:</b> <br>".$registro['descricao']."</p><br>";?>
  
                       <div class="bt">
                         <a href="<?php echo $pdf ?>"><button id="ler_livro">Ler Livro</button></a>
                         <form id="form_editar" action="editar.php" method="POST">
                           <input type = "hidden" name="id" value="<?php echo $codigo  ?>">
                           <input type="hidden" name="titulo" value="<?php echo $registro['titulo']  ?>">
                           <input type="hidden" name="ano" value="<?php echo $registro['ano']  ?>">
                           <input type="hidden" name="edicao" value="<?php echo $registro['edicao']  ?>">
                           <input type="hidden" name="bibliotecas" value="<?php echo $registro['bibliotecas']  ?>">
                           <input type="hidden" name="descricao" value="<?php echo $registro['descricao']  ?>">
                           
                           <input type="hidden" name="nomes" value="<?php echo $registro['nomes']  ?>">
                           <input type="hidden" name="apelido" value="<?php echo $registro['apelido']  ?>">
  
                           <!-- <input type="hidden" name="img" value="<?php echo $img  ?>">
                           <input type="hidden" name="pdf" value="<?php echo $pdf  ?>"> -->
                           <input type = "submit" name="editar" value="Editar Livro" id="editar">                          
                         </form>
                      </div>
                             <!-- echo '<a id="ler_livro" href ="'.$pdf.'">Ler livro</a><br>'; -->
                           <?php
                             echo "<br>"  ;
                             echo "<hr>";                
                            }
                        }

                        
                        
                      }
                      else{
                        echo "
                                <script type=\"text/javascript\">
                                  alert(\"SEM RESULTADO\");
                                </script>
                              ";
                      }  
                    } 
                  }
                  ?>

                   
              <!-- <button class="ler_livro">Ler livro</button>
              <button class="baixar_livro">Baixar livro</button> -->
            </div>
          </div>
      </div>
       
           
      <!-- Rodapé -->          
      <div class = "footer">
         @copyrights reserved to AEC  
      </div>
  </div>
  
</body>

</html>