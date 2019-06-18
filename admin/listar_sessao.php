<?php 
	require_once("inc/header.php"); 
	$list = listarSessao(NULL);
?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sessões</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="editar_sessao.php" class="btn btn-sm btn-outline-primary">Nova sessão</a>
          </div>
        </div>
      </div>

      <h2>Resultado</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nome</th>
              <th>Ativo</th>
            </tr>
          </thead>
          <tbody>
		  <?php foreach($list as $i) { ?>
            <tr>
              <td>#<?=$i["id"]?></td>
              <td><a href="editar_sessao.php?id=<?=$i["id"]?>"><?=$i["nome"]?></a></td>
              <td><?=$i["ativo"] == 1 ? "Sim" : "Não" ?></td>
            </tr>
		  <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  <?php require_once("inc/footer.php"); ?>