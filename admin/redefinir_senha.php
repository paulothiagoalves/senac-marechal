<?php 
	require_once("inc/header.php");
	$id					= NULL;
	$nome 				= NULL;
	$usuario 			= NULL;
	$email 				= NULL;
	$senha 				= NULL;
	$confirmacaoSenha 	= NULL;
	$ativo				= NULL;
	$visualizarBusca 	= FALSE;
	$visualizarInfo 	= FALSE;
	
	function preencherCampos($u) {
		$id			= $u["id"];
		$nome 		= $u["nome"];
		$usuario 	= $u["usuario"];
		$email 		= $u["email"];
		$ativo 		= $u["ativo"];
	}
	
	if(isset($_GET["id"])) {
		$u = consultarUsuario($_GET["id"]);
		$visualizarBusca 	= FALSE;
		$visualizarInfo 	= TRUE;
		preencherCampos($u);
	} else if(isset($_GET["txtBusca"])) {
		if(count(explode("@", $_GET["txtBusca"])) > 0) {
			$u = consultarUsuarioPor(NULL, NULL, $_GET["txtBusca"]);
		} else {
			$u = consultarUsuarioPor(NULL, $_GET["txtBusca"], NULL);
		}
		$visualizarBusca	= TRUE;
		$visualizarInfo		= TRUE;
		preencherCampos($u);
	} else {
		$visualizarBusca	= TRUE;
		$visualizarInfo		= FALSE;
	}
?>
<?php if($visualizarBusca) { ?>
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-10">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Localize o usuário(a)</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
					<form method="get" action="#">
						<div class="input-group">
							<input type="text" class="form-control" name="txtBusca" id="txtBusca" required placeholder="Digite o e-mail do usuário" />
							<div class="input-group-append">
							<button class="btn btn-primary" type="submit" name="btnBuscarUsuario">
								<i class="fas fa-search fa-sm"></i>
							</button>
						</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	} 
	if($visualizarInfo) { 
?>
<div class="row">
	<div class="col-md-12">
<div class="card shadow mb-10">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Redefinir senha</h6>
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
					<input type="hidden" id="txtId" name="txtId" value="<?=$id?>" />
					<input type="hidden" id="txtAtivo" name="txtAtivo" value="<?=$ativo?>" />
					<div class="form-group">
						<label for="txtNome">Nome:</label>
						<input type="text" class="form-control" id="txtNome" name="txtNome" required readonly placeholder="Nome completo" value="<?=$nome?>" />
					</div>
					<div class="form-group">
						<label for="txtUsuario">Usuário:</label>
						<input type="text" class="form-control" id="txtUsuario" name="txtUsuario" required readonly placeholder="Usuário de sistema" value="<?=$usuario?>" />
					</div>
					<div class="form-group">
						<label for="txtEmail">E-mail:</label>
						<input type="email" class="form-control" id="txtEmail" name="txtEmail" required readonly placeholder="E-mail do usuário" value="<?=$email?>" />
					</div>
					<div class="form-group">
						<label for="txtSenha">Senha:</label>
						<input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="Senha do usuário" value="" />
					</div>
					<div class="form-group">
						<label for="txtConfirmacaoSenha">Confirmação de senha:</label>
						<input type="password" class="form-control" id="txtConfirmacaoSenha" name="txtConfirmacaoSenha"  placeholder="Confirmação de senha do usuário" value="" />
					</div>
					
					<div class="form-group">
						<button type="submit" name="btnIncluir" id="btnIncluir" class="btn btn-outline-success" onclick="return confirm('Deseja realmente incluir esse registro?');"><i class="fas fa-key"></i> Redefinir senha</button>
						<a href="listar_usuario.php" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Voltar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	<?php } ?>
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