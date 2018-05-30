<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: <?= $project->color() ?>">

		
		<a class="navbar-brand" href="#">
			<?= $project->name() ?>
		</a>
		<ul class="navbar-nav" style="mix-blend-mode:;">
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

</nav>