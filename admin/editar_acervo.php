<?php 
	require_once("inc/header.php");
	$eEdicao 	= NULL;
	$id 		= NULL;
	$titulo 	= NULL;
	$texto 		= NULL;
	$arquivo	= NULL;
	$mime		= NULL;
	$ordem 		= NULL;
	$ativo 		= NULL;
	$conteudoId = $_GET["id_conteudo"];
	if(!isset($_GET["id"])) { // Inclusão
		$eEdicao = false;
		if(isset($_POST["btnIncluir"])) {
			$arquivo = uploadArquivo($_FILES["filArquivo"]);
			incluirAcervo($_POST["txtTitulo"], $_POST["txtTexto"], $arquivo,$_FILES["filArquivo"]["type"], $_POST["txtOrdem"] , $_POST["selAtivo"], $conteudoId);
			if(!is_null($id)) {
				header("location:editar_conteudo.php?id=$conteudoId&msg=incluir-sucesso");
			} else { 
				echo "<script> $('#msg').display = block; </script>";
			} 
		}
	} else { // alteração ou exclusão
		$eEdicao = true;
		if(isset($_POST["btnAlterar"])) {
			$arquivo = uploadArquivo($_FILES["filArquivo"]);
			$controle = alterarAcervo($_GET["id"], $_POST["txtTitulo"], $_POST["txtTexto"], $arquivo,$_FILES["filArquivo"]["type"], $_POST["txtOrdem"] , $_POST["selAtivo"], $conteudoId);
			if($controle) {
				$id = $_GET["id"];
				header("location:editar_conteudo.php?id=$conteudoId&msg=alterar-sucesso");
			} else {
				
			}
		} else if(isset($_POST["btnExcluir"])) {	
			$controle = excluirAcervo($_GET["id"]);
			if($controle) {
				header("location:listar_conteudo.php");
			} else {
				
			}
		} else {
			$reg = consultarAcervo($_GET["id"]);
			$dataPublicacao = formataData($reg["data_publicacao"]);
			$titulo 	= $reg["titulo"];
			$texto 		= $reg["texto"];
			$arquivo	= $reg["arquivo"];
			$ordem 		= $reg["ordem"];
			$ativo 		= $reg["ativo"];
		}
	}
?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $eEdicao ? "Editar" : "Adicionar"?> Conteúdos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="listar_conteudo.php" class="btn btn-sm btn-outline-primary">Voltar</a>
          </div>
        </div>
      </div>

      <h2>Editar</h2>
	  <div class="row">
		<div id="msg" class="alert alert-success" role="alert" style="display:none;">
			A simple success alert—check it out!
		</div>
	  </div>
      <div class="row">
		<div class="col-md-12">
			<form method="post" enctype="multipart/form-data" action="#">
				<div class="form-group">
					<label for="txtTitulo">Titulo:</label>
					<input type="text" class="form-control" id="txtTitulo" name="txtTitulo" required placeholder="Título amigavel do arquivo" value="<?=$titulo?>" />
				</div>
				<div class="form-group">
					<label for="txtTexto">Texto:</label>
					<textarea name="txtTexto" id="txtTexto" class="form-control" required placeholder="Texto descritivo do arquivo"><?=$texto?></textarea>
				</div>
				<div class="form-group">
					<img src="../upload/<?=$arquivo?>" class="img" alt="<?=$arquivo?>" height="150">
				</div>
				<div class="form-group">
					<label for="filArquivo">Arquivo:</label>
					<input type="file" class="form-control" id="filArquivo" name="filArquivo" />
				</div>
				<div class="form-group">
					<label for="txtOrdem">Ordem:</label>
					<input type="number" class="form-control" id="txtOrdem" name="txtOrdem" required placeholder="Ordem de exibição dos arquivos" value="<?=$ordem?>" />
				</div>
				<div class="form-group">
					<label for="selAtivo">Ativo:</label>
					<select name="selAtivo" id="selAtivo" class="form-control" required>
						<option value="">Selecione um opção</option>
						<option value="1" <?= $ativo == 1 ? "selected='selected'" : "" ?> >Sim</option>
						<option value="0" <?= $ativo == 0 ? "selected='selected'" : "" ?> >Não</option>
					</select>
				</div>
				<div class="form-group">
					<?php if(!$eEdicao) { ?>
					<input type="submit" name="btnIncluir" id="btnIncluir" class="btn btn-success" value="Adicionar" />
					<?php } else { ?>
					<input type="submit" name="btnAlterar" id="btnAlterar" class="btn btn-success" value="Salvar" />
					<input type="submit" name="btnExcluir" id="btnExcluir" class="btn btn-danger" value="Excluir" />
					<?php } ?>
				</div>
			</form>
		</div>
      </div>
    </main>
  <?php require_once("inc/footer.php"); ?>