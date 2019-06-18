<?php 
	require_once("inc/header.php");
	$sessao = consultarSessao($_GET["id"]);
	$conteudos = listarConteudo($_GET["id"], TRUE);
?>
<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic"><?=$sessao["nome"]?></h1>
    </div>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

	<?php 
		if(count($conteudos) > 0) {
			foreach($conteudos as $i) { 
	?>

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading"><?=$i["titulo"]?></h2>
        <p class="lead"><?=substr($i["texto"], 0, 100)?> ...</p>
		<p class="lead"><a href="detalhes.php?id=<?=$i["id"]?>">leia mais</a></p>
      </div>
      <div class="col-md-5 order-md-1">
		<?php 
			$acervo = listarAcervo($i["id"]);
			if(count($acervo) > 0) {
		?>
		<img src="upload/<?=$acervo[0]["arquivo"]?>" width="450" />
		<?php 
			} else {
		?>
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">Sem imagem</text></svg>
		<?php 
			}
		?>
      </div>
    </div>

    <hr class="featurette-divider">

	<?php 
			} 
		} else {
			echo "<h3>Sem conteúdo disponível</h3>";
		}
	?>
	

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->
  
 <?php require_once("inc/footer.php"); ?>