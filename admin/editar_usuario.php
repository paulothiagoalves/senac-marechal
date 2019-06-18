<?php 
	require_once("inc/header.php");
	$eEdicao 	= NULL;
	$nome 		= NULL;
	$usuario 	= NULL;
	$email 		= NULL;
	$senha 		= NULL;
	$confirmacaoSenha = NULL;
	$ativo 		= NULL;
	if(!isset($_GET["id"])) { // Inclusão
		$eEdicao = false;
		if(isset($_POST["btnIncluir"])) {
			$nome 		= $_POST["txtNome"];
			$usuario 	= $_POST["txtUsuario"];
			$email 		= $_POST["txtEmail"];
			$senha 		= $_POST["txtSenha"];
			$confirmacaoSenha = $_POST["txtConfirmacaoSenha"];
			$ativo 		= $_POST["selAtivo"];
			
			$valida = verificaEmail($email, NULL);
			
			if($valida["valida"] == 1) {
				echo "<script> alert('O e-mail informado já existe.'); </script>";
			} else {
			if($senha == $confirmacaoSenha) {
				$id = incluirUsuario($nome, $usuario, $email, $senha, $ativo);
				if(!is_null($id)) {
					header("location:editar_usuario.php?id=$id&msg=incluir-sucesso");
				} else { 
					echo "<script> $('#msg').display = block; </script>";
				}
			} else {
				echo "<script> alert('O campo senha e confirmação de senha não conferem.'); </script>";
			}
			}
		}
	} else { // alteração ou exclusão
		$eEdicao = true;
		if(isset($_POST["btnAlterar"])) {
			$id 		= $_GET["id"];
			$nome 		= $_POST["txtNome"];
			$usuario 	= $_POST["txtUsuario"];
			$email 		= $_POST["txtEmail"];
			$senha 		= $_POST["txtSenha"];
			$confirmacaoSenha = $_POST["txtConfirmacaoSenha"];
			$ativo 		= $_POST["selAtivo"];
			if($senha == $confirmacaoSenha) {
				$controle = alterarUsuario($id, $nome, $usuario, $email, $senha, $ativo);
				if($controle) {
					header("location:editar_usuario.php?id=$id&msg=alterar-sucesso");
				} else {
				
				}
			} else {
				echo "<script> alert('O campo senha e confirmação de senha não conferem.'); </script>";
			}
		} else if(isset($_POST["btnExcluir"])) {	
			$controle = excluirUsuario($_GET["id"]);
			if($controle) {
				header("location:listar_usuario.php");
			} else {
				
			}
		} else {
			$reg = consultarUsuario($_GET["id"]);
			$nome 		= $reg["nome"];
			$usuario 	= $reg["usuario"];
			$email 		= $reg["email"];
			$ativo 		= $reg["ativo"];
			
		}
	}
?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $eEdicao ? "Editar" : "Adicionar"?> Usuário</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="listar_usuario.php" class="btn btn-sm btn-outline-primary">Voltar</a>
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
			<form name="form" id="form" method="post" action="#">
				<div class="form-group">
					<label for="txtNome">Nome:</label>
					<input type="text" class="form-control" id="txtNome" name="txtNome" required placeholder="Nome da sessão" value="<?=$nome?>" />
				</div>
				<div class="form-group">
					<label for="txtUsuario">Usuário:</label>
					<input type="text" class="form-control" id="txtUsuario" name="txtUsuario" required placeholder="Nome do usuário" value="<?=$usuario?>" />
				</div>
				<div class="form-group">
					<label for="txtSenha">Senha:</label>
					<input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="Senha do usuário" value="<?=$senha?>" />
				</div>
				<div class="form-group">
					<label for="txtConfirmacaoSenha">Confirmação de senha:</label>
					<input type="password" class="form-control" id="txtConfirmacaoSenha" name="txtConfirmacaoSenha"  placeholder="Confirmação de senha do usuário" value="<?=$confirmacaoSenha?>" />
				</div>
				<div class="form-group">
					<label for="txtEmail">E-mail:</label>
					<input type="email" class="form-control" id="txtEmail" name="txtEmail" required placeholder="E-mail do usuário" value="<?=$email?>" />
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
					<input type="submit" name="btnIncluir" id="btnIncluir" class="btn btn-success" value="Adicionar" onclick="return adicionar();" />
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
  <script>
	function adicionar() {
		if(document.form.txtSenha.value == "" ) {
			alert("Preenchimento de senha obrigatório");
			return false;
		} else if(document.form.txtConfirmacaoSenha.value == "" ) {
			alert("Preenchimento de confirmação de senha obrigatório");
			return false;
		} else {
			return true;
		}
	}
  </script>