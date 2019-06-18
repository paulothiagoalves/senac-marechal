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
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $eEdicao ? "Editar" : "Adicionar"?> Sessões</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="listar_sessao.php" class="btn btn-sm btn-outline-primary">Voltar</a>
          </div>
        </div>
      </div>

      <h2>Editar</h2>
	  <?php if(isset($_GET["msg"])) { ?>
	  <div class="row">
		<div id="msg" class="alert alert-success" role="alert" >
			<?=$_GET["msg"];?>
		</div>
	  </div>
	  <?php } ?>
      <div class="row">
		<div class="col-md-12">
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
					<input type="submit" name="btnIncluir" id="btnIncluir" class="btn btn-success" value="Adicionar" onclick="return confirm('Deseja realmente incluir esse registro?');" />
					<?php } else { ?>
					<input type="submit" name="btnAlterar" id="btnAlterar" class="btn btn-success" value="Salvar" onclick="return confirm('Deseja realmente alterar esse registro?');" />
					<input type="submit" name="btnExcluir" id="btnExcluir" class="btn btn-danger" value="Excluir" onclick="return confirm('Deseja realmente excluir esse registro?');" />
					<?php } ?>
				</div>
			</form>
		</div>
      </div>
    </main>
  <?php require_once("inc/footer.php"); ?>