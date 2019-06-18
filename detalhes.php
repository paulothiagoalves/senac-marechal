<?php 
	require_once("inc/header.php"); 
	$conteudo = consultarConteudo($_GET["id"]);
	$acervo = listarAcervo($_GET["id"]);
	//echo count($acervo); exit();
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
		<?php for($i=0; $i < count($acervo); $i++) { ?>
      <li data-target="#myCarousel" data-slide-to="<?=$i?>" <?=$i == 0 ? "class='active'" : "" ?> ></li>
		<?php } ?>
    </ol>
    <div class="carousel-inner">
		<?php 
			$primeiro = TRUE;
			foreach($acervo as $a) { 
		?>
      <div class="carousel-item <?php if($primeiro) { echo "active"; $primeiro = FALSE; } ?>" >
        <img src="upload/<?=$a["arquivo"]?>" class="d-block w-100" alt="...">
        <div class="container">
          <div class="carousel-caption text-left">
            <h1><?=$a["titulo"]?></h1>
            <p><?=$a["texto"]?></p>
          </div>
        </div>
      </div>
		<?php 
			} 
		?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <h1>Titulo</h1>
	
	<p>Texto</p>

  </div><!-- /.container -->
  
 <?php require_once("inc/footer.php"); ?>