<?php 
	$title = 'OneToDo | Accueil projet';
	ob_start();
?>

	<?php require('projectNavbar.php'); ?>
	<div class="container-fluid">
		<div class="row content-project">
			<div class="col-xl-12">
				<h4>Home - <?= $project->name() ?></h4>
				<hr>
			</div>
			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
				<a href="tâches">
					<div class=" tiles rounded d-flex align-items-center justify-content-center" style="background-color: <?= $project->color() ?>">
						<div class="text-center">
							<i class="fas fa-tasks fa-3x"></i>
							<p>Todolists</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
				<a href="wiki">
					<div class="tiles rounded d-flex align-items-center justify-content-center" style="background-color: <?= $project->color() ?>">
						<div class="text-center">
							<i class="fas fa-edit fa-3x"></i>
							<p>Wiki</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
				<a href="utilisateurs">
					<div class="tiles rounded d-flex align-items-center justify-content-center" style="background-color: <?= $project->color() ?>">
						<div class="text-center">
							<i class="fas fa-users fa-3x"></i>
							<p>Utilisateurs</p>
						</div>
					</div>
				</a>
			</div>
			<?php if($access->access <= 1): ?>
			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
				<a href="parametres">
					<div class="tiles rounded d-flex align-items-center justify-content-center" style="background-color: <?= $project->color() ?>">
						<div class="text-center">
							<i class="fas fa-cogs fa-3x"></i>
							<p>Paramètres</p>
						</div>
					</div>
				</a>
			</div>
			<?php endif; ?>
		</div>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>