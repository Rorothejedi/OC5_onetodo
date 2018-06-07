<?php 
	$title = 'OneToDo | Tous les projets ouverts';
	ob_start();
?>

	<div class="container-fluid">
		<nav aria-label="breadcrumb">
  			<ol class="breadcrumb">
    			<li class="breadcrumb-item"><a href="dashboard">Tableau de bord</a></li>
    			<li class="breadcrumb-item active" aria-current="page">Tous les projets ouverts</li>
  			</ol>
		</nav>
		<br>
		<div class="row">
			<div class="col-xl-12">
				<div class="jumbotron">
					<div class="row d-flex justify-content-between align-items-center mb-4">
						<div class="col-xl-8 col-lg-12">
							<h5>Rejoignez des projets ouverts</h5>
						</div>
						<div class="col-xl-4 col-lg-8 col-md-12">
							<form action="projetsOuverts" method="GET">
								<div class="input-group">
									<input type="search" name="search" class="form-control" placeholder="Rechercher..." aria-label="Rechercher un projet ouvert">
									<div class="input-group-append">
									    <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<hr>
					<div class="table-responsive">
						<table class="table">
							<?php 
							if (isset($_GET['search']) && !empty($_GET['search']) && count($openProjects) == 0) 
							{
								echo '<em>Pas de résultat pour la recherche <strong>"' . $_GET['search'] . '"</strong> ...</em>';
							}

							foreach ($openProjects as $key => $openProject): ?>
							<tr class="firstRow button-open-table-row" id="button-<?= $openProject->id_project ?>">
								<td class="text-center align-middle" style="width: 100px">
									
										<?php if ($openProject->open == 0): ?>

										<div class="d-flex rounded-circle color-circle align-items-center justify-content-center m-auto" style="background: <?= $openProject->color ?>" title="Observateur" data-toggle="tooltip" data-placement="right">
											<i class="fas fa-eye text-white"></i>
										</div>

										<?php else: ?>
										
										<div class="d-flex rounded-circle color-circle align-items-center justify-content-center m-auto" style="background: <?= $openProject->color ?>" title="Contributeur" data-toggle="tooltip" data-placement="right">
											<i class="fas fa-pencil-alt text-white"></i>
										</div>

										<?php endif; ?>
									
								</td>
								<td class="pl-4 align-middle" style="min-width: 250px">
									<?= $openProject->name ?>
								</td>
								<td class="text-right">
									<button class="btn btn-light rounded-circle" title="En savoir plus" data-toggle="tooltip" data-trigger="hover" data-placement="left">
										<i class="fas fa-ellipsis-h"></i>
									</button>
								</td>
							</tr>
							<tr class="secondRow">
								<td colspan="2" class="hidden row-table-more align-middle" id="row_table-<?= $openProject->id_project ?>" style="height: 100px">
									<div class="hidden block-table-more" id="block_table-<?= $openProject->id_project ?>">
										<?php 
											if ($openProject->description == null) 
											{
												echo "<em>Pas de description disponible</em>";
											}
											else
											{
												echo '<em>' . $openProject->description . '</em>';
											}
										 ?>
									</div>
								</td>
								<td class="text-right hidden row-table-more align-middle" id="row_table-<?= $openProject->id_project ?>-bis">
									<div class="hidden block-table-more" id="block_table-<?= $openProject->id_project ?>-bis">
										<form action="processAddUserOpenProject" method="POST">
											<input type="hidden" name="id_open_project" value="<?= $openProject->id_project ?>">
											<input type="hidden" name="addOpenProject" value="addOpenProject">
											<button type="submit" class="btn btn-primary">Rejoindre ce projet</button>
										</form>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
?>	