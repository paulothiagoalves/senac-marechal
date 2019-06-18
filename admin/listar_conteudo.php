<?php 
	require_once("inc/header.php"); 
	$list = listarConteudo(NULL, NULL);
?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Conteúdos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="editar_conteudo.php" class="btn btn-sm btn-outline-primary">Novo conteúdo</a>
          </div>
        </div>
      </div>

      <h2>Resultado</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Id</th>
			  <th>Sessão</th>
              <th>Data de publicação</th>
			  <th>Título</th>
              <th>Ativo</th>
            </tr>
          </thead>
          <tbody>
		  <?php foreach($list as $i) { ?>
            <tr>
              <td>#<?=$i["id"]?></td>
			  <td><?=$i["nome_sessao"]?></td>
			  <td><?=formataData($i["data_publicacao"])?></td>
              <td><a href="editar_conteudo.php?id=<?=$i["id"]?>"><?=$i["titulo"]?></a></td>
              <td><?=$i["ativo"] == 1 ? "Sim" : "Não" ?></td>
            </tr>
		  <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  <?php require_once("inc/footer.php"); ?>