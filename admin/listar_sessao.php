<?php 
	require_once("inc/header.php"); 
	$list = listarSessao(NULL);
?>

	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Sessões</h6>
			<a href="editar_sessao.php" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Adicionar</a>
        </div>
		
        <div class="card-body">
			<div class="row">
				<div class="col-md-12">
					
				</div>
			</div>
			<div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Ativo</th>
                    </tr>
                  </thead>
				  <tbody>
					<?php foreach($list as $i) { ?>
						<tr>
							<td><a href="editar_sessao.php?id=<?=$i["id"]?>"><?=$i["nome"]?></a></td>
							<td><?=$i["ativo"] == 1 ? "Sim" : "Não" ?></td>
						</tr>
					<?php } ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>

  <?php require_once("inc/footer.php"); ?>