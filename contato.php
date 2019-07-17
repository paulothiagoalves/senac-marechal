<?php 
	require_once("inc/header.php"); 
	$id = NULL;
	if(isset($_POST["btnEnviar"])) {
		$id = incluirContato($_POST["nome"], $_POST["email"], $_POST["assunto"], $_POST["texto"]);
	}
?>

  <div class="container marketing">

    <h1>Contato</h1>
	
	<?php if(!is_null($id)) { ?>
		Contato realizado com sucesso.
	<?php } ?>
	
	<form method="post" action="#">
	
		<p><input type="text" name="nome" required placeholder="Nome" /></p>
	
		<p><input type="text" name="email" required placeholder="E-Mail" /></p>
	
		<p><input type="text" name="assunto" required placeholder="Assunto" /></p>
	
		<p><textarea name="texto" required placeholder="Texto"></textarea></p>
	
		<button name="btnEnviar" type="submit">Enviar</button>
	</form>
  </div><!-- /.container -->
  
 <?php require_once("inc/footer.php"); ?>