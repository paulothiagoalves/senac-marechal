<?php 
	require_once("inc/header.php"); 
	$list = listarConteudo(NULL, NULL);
?>

	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Conteúdos</h6>
			<a href="editar_conteudo.php" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Adicionar</a>
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
							<th>Sessão</th>
							<th>Data de publicação</th>
							<th>Título</th>
							<th>Ativo</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($list as $i) { ?>
						<tr>
							<td><?=$i["nome_sessao"]?></td>
							<td><?=formataData($i["data_publicacao"])?></td>
							<td><?=$i["titulo"]?></td>
							<td><?=$i["ativo"] == 1 ? "Sim" : "Não" ?></td>
							<td>
								<a href="editar_conteudo.php?id=<?=$i["id"]?>" class="btn btn-outline-primary btn-circle btn-sm">
									<i class="fas fa-edit"></i>
								</a>
								<a href="editar_sessao.php?id=<?=$i["sessao_id"]?>" class="btn btn-outline-primary btn-circle btn-sm">
									<i class="fas fa-sitemap"></i>
								</a>
								<a href="#" class="btn btn-outline-danger btn-circle btn-sm">
									<i class="fas fa-trash"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

  <?php require_once("inc/footer.php"); ?>