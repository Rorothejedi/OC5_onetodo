<?php 
	$title = 'OneToDo | Tableau de bord';
	ob_start();

	$myProjectContent         = false;
	$contributeProjectContent = false;
	$watchProjectContent      = false;

	for ($i = 0; $i < count($projects); $i++) 
	{ 
		if ($projects[$i]->access == 1)
		{
			$myProjectContent = true;
		}
		elseif ($projects[$i]->access == 2) 
		{
			$contributeProjectContent = true;
		}
		elseif ($projects[$i]->access == 3) 
		{
			$watchProjectContent = true;
		}
	} 

?>

	<div class="container-fluid">
	
		<nav aria-label="breadcrumb">
  			<ol class="breadcrumb">
    			<li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
  			</ol>
		</nav>
		<br>

		<?php if ($myProjectContent === true): ?>
		<!-- Your projects -->
		<a href="#myProjectContent" data-toggle="collapse" aria-expanded="false" class="activeCollapse">
		    <h3 class="justify-content-between d-flex title_content">Vos projets <i class="fas fa-caret-down rotate down"></i></h3>
		</a>
		<hr>
		<div class="row collapse show" id="myProjectContent">

		<?php 
			foreach ($projects as $key => $project): 
				if ($project->access == 1):
		?>

			<div class="col-xl-3 col-lg-4 col-sm-6 tiles_project">
				<a href="projet/<?= $project->link ?>/home">
					<div class="card" style="background-color: <?= $project->color ?>">
	  					<div class="card-header d-flex justify-content-between">
	  						<?= $project->name ?>
	  						<div class="text-right">
	  							<?php 
		  							if ($project->status == 0) 
		  							{
		  								echo '<i class="fas fa-lock" title="Projet privé"></i>';
		  							}
		  							else
		  							{
		  								echo '<i class="fas fa-lock-open" title="Projet ouvert"></i>';
		  							}
	  							?>
	  						</div>
	  					</div>
	  					<div class="card-body">
	  						<p class="card-text">
	  							<?php if (isset($project->description)) { echo $project->description;} ?>
	  						</p>
	  					</div>
	  				</div>
  				</a>
			</div>

		<?php 
				endif;
			endforeach;
		?>

		</div>

		<?php 
			else:
		?>
		<br>
		<h5>Vous n'avez pas encore créé votre projet ? <a href="nouveauProjet">Lancez-vous</a> !</h5>

		<?php
			endif; 
			if ($contributeProjectContent === true):
		?>

		<!-- Your contribute projects -->
		<a href="#contributeProjectContent" data-toggle="collapse" aria-expanded="false" class="activeCollapse">
		    <h3 class="justify-content-between d-flex title_content">Contributeur <i class="fas fa-caret-down rotate down"></i></h3>
		</a>
		<hr>
		<div class="row collapse show" id="contributeProjectContent">

			<?php 
				foreach ($projects as $key => $project): 
					if ($project->access == 2):
			?>

			<div class="col-xl-3 col-lg-4 col-sm-6 tiles_project">
				<a href="projet/<?= $project->link ?>/home">
					<div class="card" style="background-color: <?= $project->color ?>">
	  					<div class="card-header d-flex justify-content-between">
	  						<?= $project->name ?>
	  						<div class="text-right">
	  							<?php 
		  							if ($project->status == 0) 
		  							{
		  								echo '<i class="fas fa-lock" title="Projet privé"></i>';
		  							}
		  							else
		  							{
		  								echo '<i class="fas fa-lock-open" title="Projet ouvert"></i>';
		  							}
	  							?>
	  						</div>
	  					</div>
	  					<div class="card-body">
	  						<p class="card-text">
		  						<?php if (isset($project->description)) { echo $project->description;} ?>
		  					</p>
	  					</div>
	  				</div>
  				</a>
			</div>

			<?php 
					endif;
				endforeach;
			?>
			
		</div>

		<?php 
			endif; 
			if ($watchProjectContent === true):
		?>

		<!-- Your contribute projects -->
		<a href="#watchProjectContent" data-toggle="collapse" aria-expanded="false" class="activeCollapse">
		    <h3 class="justify-content-between d-flex title_content">Observateur <i class="fas fa-caret-down rotate down"></i></h3>
		</a>
		<hr>
		<div class="row collapse show" id="watchProjectContent">

			<?php 
				foreach ($projects as $key => $project): 
					if ($project->access == 3):
			?>

			<div class="col-xl-3 col-lg-4 col-sm-6 tiles_project">
				<a href="projet/<?= $project->link ?>/home">
					<div class="card" style="background-color: <?= $project->color ?>">
	  					<div class="card-header d-flex justify-content-between">
	  						<?= $project->name ?>
	  						<?php 
	  							if ($project->status == 0) 
	  							{
	  								echo '<i class="fas fa-lock" title="Projet privé"></i>';
	  							}
	  							else
	  							{
	  								echo '<i class="fas fa-lock-open" title="Projet ouvert"></i>';
	  							}
  							?>
	  					</div>
	  					<div class="card-body">
	  						<p class="card-text">
		  						<?php if (isset($project->description)) { echo $project->description;} ?>
		  					</p>
	  					</div>
	  				</div>
  				</a>
			</div>

			<?php 
					endif;
				endforeach;
			?>
		</div>

		<?php endif; ?>

	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
?>