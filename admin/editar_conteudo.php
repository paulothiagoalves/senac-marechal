<?php 
	require_once("inc/header.php");
	$eEdicao 	= NULL;
	$listSessao = listarSessao(TRUE);
	$dataPublicacao = NULL;
	$titulo 	= NULL;
	$texto 		= NULL;
	$ativo 		= NULL;
	$sessaoId 	= NULL;
	if(!isset($_GET["id"])) { // Inclusão
		$eEdicao = false;
		if(isset($_POST["btnIncluir"])) {
			$id = incluirConteudo(formataData($_POST["txtDataPublicacao"]), $_POST["txtTitulo"], $_POST["txtTexto"], $_POST["selAtivo"], $_POST["selSessao"]);
			if(!is_null($id)) {
				header("location:editar_conteudo.php?id=$id&msg=incluir-sucesso");
			} else { 
				echo "<script> $('#msg').display = block; </script>";
			} 
		}
	} else { // alteração ou exclusão
		$eEdicao = true;
		if(isset($_POST["btnAlterar"])) {
			$controle = alterarConteudo($_GET["id"], formataData($_POST["txtDataPublicacao"]), $_POST["txtTitulo"], $_POST["txtTexto"], $_POST["selAtivo"], $_POST["selSessao"]);
			if($controle) {
				$id = $_GET["id"];
				header("location:editar_conteudo.php?id=$id&msg=alterar-sucesso");
			} else {
				
			}
		} else if(isset($_POST["btnExcluir"])) {	
			$controle = excluirConteudo($_GET["id"]);
			if($controle) {
				header("location:listar_conteudo.php");
			} else {
				
			}
		} else {
			$reg = consultarConteudo($_GET["id"]);
			$id 		= $reg["id"];
			$dataPublicacao = formataData($reg["data_publicacao"]);
			$titulo 	= $reg["titulo"];
			$texto 		= $reg["texto"];
			$ativo 		= $reg["ativo"];
			$sessaoId 	= $reg["sessao_id"];
			$acervos 	= listarAcervo($reg["id"], NULL);
		}
	}
?>
<div class="card shadow mb-10">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $eEdicao ? "Editar" : "Adicionar"?> Conteúdo</h6>
    </div>
    <div class="card-body">
        <div class="row">
			<div class="col-md-12">
				<?php if(isset($_GET["msg"])) { ?>
					<div id="msg" class="alert alert-success" role="alert" >
						<?=$_GET["msg"];?>
					</div>
				<?php } ?>
				<form method="post" action="#">
					<div class="form-group">
						<label for="selSessao">Sessão:</label>
						<select name="selSessao" id="selSessao" class="form-control" required >
							<option value="">Selecione uma opção</option>
							<?php foreach($listSessao as $i) { ?>
								<option <?=$i["id"] == $sessaoId ? "selected='selected'" : "" ?>  value="<?=$i["id"]?>"><?=$i["nome"]?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="txtDataPublicacao">Data publicação:</label>
						<input type="text" class="form-control" id="txtDataPublicacao" name="txtDataPublicacao" required placeholder="Data de publicação" value="<?=$dataPublicacao?>" />
					</div>
					<div class="form-group">
						<label for="txtTitulo">Título:</label>
						<input type="text" class="form-control" id="txtTitulo" name="txtTitulo" required placeholder="Título do conteúdo" value="<?=$titulo?>" />
					</div>
					<div class="form-group">
						<label for="txtTexto">Texto:</label>
						<textarea name="txtTexto" id="txtTexto" class="form-control" required placeholder="Texto do conteúdo"><?=$texto?></textarea>
					</div>
					<div class="form-group">
						<label for="selAtivo">Ativo:</label>
						<select name="selAtivo" id="selAtivo" class="form-control" required>
							<option value="">Selecione um opção</option>
							<option value="1" <?= $ativo == 1 ? "selected='selected'" : "" ?> >Sim</option>
							<option value="0" <?= $ativo == 0 ? "selected='selected'" : "" ?> >Não</option>
						</select>
					</div>
					<?php if($eEdicao) { ?>
					<div class="form-group">
						<a href="editar_acervo.php?id_conteudo=<?=$reg["id"]?>" class="btn btn-outline-primary btn-md" >
							<i class="fas fa-plus"></i> Adicionar imagem
						</a>
					</div>
					<?php if(count($acervos) > 0) { ?>
					<div class="card-group">
						<?php foreach($acervos as $img) { ?>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-bottom-primary" >
								<img class="card-img-top" src="<?= is_null($img["arquivo"]) ? "img/template.png" : "../upload/" . $img["arquivo"]?>"  alt="<?=$img["arquivo"]?>" >
								<div class="card-body">
									<h4 class="card-title">
										<?=$img["titulo"]?>
									</h4>
									<p class="card-text">
										<strong>Ordem:</strong> 
										<?=$img["ordem"]?>
									</p>
									<p class="card-text">
										<strong>Ativo:</strong>
										<?=$img["ativo"] == 1 ?  "Sim" : "Não" ?>
									</p>
									<a href="editar_acervo.php?id=<?=$img["id"]?>&id_conteudo=<?=$reg["id"]?>" class="btn btn-outline-success btn-circle btn-md">
										<i class="fas fa-edit"></i>
									</a>
									<a href="editar_acervo.php?id=<?=$img["id"]?>&id_conteudo=<?=$reg["id"]?>&btnExcluir=true" class="btn btn-outline-danger btn-circle btn-md">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
					<?php } ?>
					<div class="form-group">
						<?php if(!$eEdicao) { ?>
						<button type="submit" name="btnIncluir" id="btnIncluir" class="btn btn-outline-success" onclick="return confirm('Deseja realmente incluir esse registro?');"><i class="fas fa-save"></i> Adicionar </button>
						<?php } else { ?>
						<button type="submit" name="btnAlterar" id="btnAlterar" class="btn btn-outline-success" value="Salvar" onclick="return confirm('Deseja realmente alterar esse registro?');" ><i class="fas fa-save"></i> Alterar </button>
						<button type="submit" name="btnExcluir" id="btnExcluir" class="btn btn-outline-danger" value="Excluir" onclick="return confirm('Deseja realmente excluir esse registro?');" ><i class="fas fa-trash"></i> Excluir</button>
						<?php } ?>
						<a href="listar_conteudo.php" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Voltar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
  <?php require_once("inc/footer.php"); ?>