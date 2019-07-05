<?php 
	require_once("inc/header.php");
	$eEdicao = NULL;
	$nome = NULL;
	$ativo = NULL;
	if(!isset($_GET["id"])) { // Inclusão
		$eEdicao = false;
		if(isset($_POST["btnIncluir"])) {
			$id = incluirSessao($_POST["txtNome"], $_POST["selAtivo"]);
			if(!is_null($id)) {
				//header("location:listar_sessao.php");	
				header("location:editar_sessao.php?id=$id&msg=Resistro $id incluido com sucesso!");
			} else { 
				echo "<script> $('#msg').display = block; </script>";
			} 
		}
	} else { // alteração ou exclusão
		$eEdicao = true;
		if(isset($_POST["btnAlterar"])) {
			$controle = alterarSessao($_GET["id"], $_POST["txtNome"],  $_POST["selAtivo"]);
			if($controle) {
				$id = $_GET["id"];
				header("location:editar_sessao.php?id=$id&msg=alterar-sucesso");
			} else {
				
			}
		} else if(isset($_POST["btnExcluir"])) {	
			$controle = excluirSessao($_GET["id"]);
			if($controle) {
				header("location:listar_sessao.php");
			} else {
				
			}
		} else {
			$reg = consultarSessao($_GET["id"]);
			$nome = $reg["nome"];
			$ativo = $reg["ativo"];
		}
	}
?>

	<div class="card shadow mb-10">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $eEdicao ? "Editar" : "Adicionar"?> Sessões</h6>
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
							<label for="txtNome">Nome:</label>
							<input type="text" class="form-control" id="txtNome" name="txtNome" required placeholder="Nome da sessão" value="<?=$nome?>" />
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
							<button type="submit" name="btnIncluir" id="btnIncluir" class="btn btn-outline-success" onclick="return confirm('Deseja realmente incluir esse registro?');"><i class="fas fa-save"></i> Adicionar </button>
							<?php } else { ?>
							<button type="submit" name="btnAlterar" id="btnAlterar" class="btn btn-outline-success" value="Salvar" onclick="return confirm('Deseja realmente alterar esse registro?');" ><i class="fas fa-save"></i> Alterar </button>
							<button type="submit" name="btnExcluir" id="btnExcluir" class="btn btn-outline-danger" value="Excluir" onclick="return confirm('Deseja realmente excluir esse registro?');" ><i class="fas fa-trash"></i> Excluir</button>
							<?php } ?>
							<a href="listar_sessao.php" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Voltar</a>
						</div>
					</form>
				</div>
			</div>
        </div>
	</div>

  <?php require_once("inc/footer.php"); ?>