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
				echo "<script>document.location.href = 'editar_conteudo.php?id=$conteudoId&msg=alterar-sucesso';</script>";
			} else {
				
			}
		} else if(isset($_POST["btnExcluir"]) || isset($_GET["btnExcluir"])) {	
			$controle = excluirAcervo($_GET["id"]);
			if($controle) {
				echo "<script>document.location.href = 'editar_conteudo.php?id=$conteudoId&msg=alterar-sucesso';</script>";
			} else {
				
			}
		} else {
			$reg = consultarAcervo($_GET["id"]);
			$titulo 	= $reg["titulo"];
			$texto 		= $reg["texto"];
			$arquivo	= $reg["arquivo"];
			$ordem 		= $reg["ordem"];
			$mime 		= $reg["mine"];
			$ativo 		= $reg["ativo"];
		}
	}
?>
<div class="card shadow mb-10">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $eEdicao ? "Editar" : "Adicionar"?> Acervo</h6>
    </div>
    <div class="card-body">
        <div class="row">
			<div class="col-md-12">
				<?php if(isset($_GET["msg"])) { ?>
					<div id="msg" class="alert alert-success" role="alert" >
						<?=$_GET["msg"];?>
					</div>
				<?php } ?>
				<form method="post" enctype="multipart/form-data" action="#">
					<div class="form-group">
						<label for="txtTitulo">Titulo:</label>
						<input type="text" class="form-control" id="txtTitulo" name="txtTitulo" required placeholder="Título amigavel do arquivo" value="<?=$titulo?>" />
					</div>
					<div class="form-group">
						<label for="txtTexto">Texto:</label>
						<textarea name="txtTexto" id="txtTexto" class="form-control" required placeholder="Texto descritivo do arquivo"><?=$texto?></textarea>
					</div>
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-bottom-primary" >
							<img class="card-img-top" src="../upload/<?=$arquivo?>" class="img" alt="<?=$arquivo?>" height="150">
						</div>
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
						<button type="submit" name="btnIncluir" id="btnIncluir" class="btn btn-outline-success" onclick="return confirm('Deseja realmente incluir um novo registro?');"><i class="fas fa-save"></i> Adicionar </button>
						<?php } else { ?>
						<button type="submit" name="btnAlterar" id="btnAlterar" class="btn btn-outline-success" value="Salvar" onclick="return confirm('Deseja realmente alterar esse registro?');" ><i class="fas fa-save"></i> Alterar </button>
						<button type="submit" name="btnExcluir" id="btnExcluir" class="btn btn-outline-danger" value="Excluir" onclick="return confirm('Deseja realmente excluir esse registro?');" ><i class="fas fa-trash"></i> Excluir</button>
						<?php } ?>
						<a href="editar_conteudo.php?id=<?=$_GET["id_conteudo"]?>" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Voltar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
  <?php require_once("inc/footer.php"); ?>