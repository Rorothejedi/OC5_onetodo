<?php 
	$title = 'Wiki projet';
	ob_start();
	require('projectNavbar.php');
?>

	<div class="container-fluid">
		<div class="row content-project">
			<div class="col-lg-12">
				<h4>Wiki</h4>
				<div class="jumbotron">
					<div class="container" id="read-wiki-block">
						<?php 
							if (empty($project->wiki())) 
							{
								echo "<p>Le wiki de <strong>" . $project->name() . "</strong> est vide...</p>";
							}
							else
							{
								echo $project->wiki();
							}
						?>
					</div>
					<?php if($access->access <= 2): ?>
					<div class="container hidden" id="edit-wiki-block">
						<form action="processEditWiki" method="POST" id="main-form">
							<div class="form-group">
								<textarea name="wikiProject" id="tinymce" class="wikiProject"><?= $project->wiki() ?></textarea>
							</div>
							<input type="hidden" name="editWiki" value="editWiki">
							<button type="submit" class="btn btn-primary" data-confirm="Etes-vous sûr de vouloir appliquer les modifications apportées au wiki ?">Confirmer les modifications</button>
							<button type="button" class="btn btn-secondary button-cancel-edit-wiki">Annuler</button>
						</form>
					</div>
					<div class="container">
						<br>
						<button class="btn btn-dark button-edit-wiki">Modifier le wiki ?</button>
					</div>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php 
	$content = ob_get_clean();
	require('./view/template/templateProject.php');
?>