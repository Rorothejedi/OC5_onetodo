<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		
		<a class="navbar-brand" href="#">
			<?= $project->name() ?>
		</a>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="<?= \App\model\App::getDomainPath(); ?>/projet/<?= $project->link() ?>/tâches">Todolist</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= \App\model\App::getDomainPath(); ?>/projet/<?= $project->link() ?>/wiki">Wiki</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= \App\model\App::getDomainPath(); ?>/projet/<?= $project->link() ?>/utilisateurs">Utilisateurs</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= \App\model\App::getDomainPath(); ?>/projet/<?= $project->link() ?>/parametres">Paramètres</a>
			</li>
		</ul>
	</div>
</nav>