<?php 
	require_once("../app.php");
	if(isset($_POST["btnSignIn"])) {
		$usuario 	= $_POST["txtUsuario"];
		$senha 		= $_POST["txtSenha"];
		$user = autenticacaoUsuario($usuario, $senha);
		if(!is_null($user)) {
			criarCredencial($user);
		} else {
			echo "<script> alert('Usuario e senha incorreto.'); </script>";
		}
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>CMS - Acesso a área administrativa</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.3/examples/floating-labels/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" method="POST" action="#">
		<div class="text-center mb-4">
			<h1 class="h3 mb-3 font-weight-normal">Acesso ao sistema</h1>
		</div>
		<div class="form-label-group">
			<input type="text" id="txtUsuario" name="txtUsuario" class="form-control" placeholder="Usuário" required autofocus>
			<label for="txtUsuario">Usuário</label>
		</div>

		<div class="form-label-group">
			<input type="password" id="txtSenha" name="txtSenha" class="form-control" placeholder="Password" required>
			<label for="txtSenha">Senha</label>
		</div>

		<div class="checkbox mb-3">
			<label>
				<input type="checkbox" value="remember-me"> Lembrar da minha senha
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="btnSignIn">Sign in</button>
		<p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2019</p>
</form>
</body>
</html>
