<?php 
	$title = 'OneToDo | Utilisateurs du projet';
	ob_start();
	require('projectNavbar.php');
?>

	<div class="container-fluid">
		<div class="row content-project">
			<div class="col-lg-12">
				<?php if($access->access <= 1): ?>
				<h4 class="hidden title-add-user">Ajouter un utilisateur</h4>
				<button class="btn btn-secondary button-add-user mb-4">Ajouter un utilisateur</button>
				<div class="jumbotron pb-4 block-add-user hidden">
					<form action="processAddUserInProject" method="POST">
						<div class="form-row">
							<div class="col-lg-6">
								<div class="form-group">
									<input name="newUserProject" type="text" class="form-control" placeholder="Nom d'utilisateur ou adresse email" required>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<select name="statusNewUserProject" class="form-control" required>
										<option value="" selected disabled>Status de l'utilisateur</option>
										<option value="2">Contributeur</option>
										<option value="3">Observateur</option>
									</select>
								</div>
							</div>
							<div class="col-lg-2">
								<button class="btn btn-primary btn-block">Ajouter</button>
							</div>
						</div>
					</form>
					<div>
						<p class="text-muted mb-1 mt-3">Pour affilier un nouvel utilisateur à votre projet, indiquez son nom d'utilisateur ou son adresse mail.</p>
						<ul>
							<li class="text-muted">Si celui-ci a un compte sur la plateforme, il sera ajouté immédiatement.</li>
							<li class="text-muted">Si ce n'est pas le cas, un mail lui sera envoyé à l'adresse mail que vous avez renseignée pour le solliciter à nous rejoindre.</li>
						</ul>
					</div>
				</div>
				<?php endif; ?>
				<h4>Utilisateurs affiliés au projet</h4>
				<div class="jumbotron">
					<div class="table-responsive">
						<table class="table table-hover">
							<?php foreach ($users as $key => $user): ?>
							<tr>
								<td class="text-center" style="width: 100px">
									<?php 
										$avatar = new \App\model\Avatar($user->email, 50); 
										echo $avatar->generateGravatar();
								 	?>
								</td>
						     	<td class="align-middle" style="width: 300px; min-width: 150px"><?= $user->username ?></td>
								
						     	<?php 
						     		if($access->access <= 1): 
						     			if ($user->access <= 1):
						     				echo '<td class="align-middle"><i class="fas fa-crown"></i> Fondateur</td>';
						     	 		else: 
						     	?>
						     	<td class="align-middle" style="width: 400px; min-width: 200px">
									<form action="processChangeUserStatus" method="POST">
										<input type="hidden" name="changeUserStatus" value="changeUserStatus">
										<input type="hidden" name="id_user" value="<?= $user->id_user ?>">
										<select name="changeStatus" class="form-control select-change-access" style="max-width: 80%" onchange="this.form.submit()" disabled>
											<option value="2" <?php if ($user->access == 2) {echo "selected";} ?>>Contributeur</option>
											<option value="3" <?php if ($user->access == 3) {echo "selected";} ?>>Observateur</option>
										</select>
									</form>
								</td>
									<?php 
										endif; 
										if ($user->access >= 2):
									?>
						     	
						     	<td class="align-middle text-center" style="width: 80px">
									<form action="processRemoveUserProject" method="POST" class="withdraw-form">
										<input type="hidden" name="removeUser" value="removeUser">
										<input type="hidden" name="id_user" value="<?= $user->id_user ?>">
										<button class="btn btn-light rounded-circle btn-remove-user" data-confirm-withdraw="Voulez-vous vraiment retirer <?= $user->username ?> du projet ?" title="Retirer du projet" data-toggle="tooltip" data-trigger="hover" disabled>
											<i class="fas fa-times"></i>
										</button>
									</form>
						     	</td>

						    	<?php 
						    			else:
						    				echo '<td class="align-middle"></td>';
						    			endif;
						    		else: 
						    	?>
						     	<td class="align-middle">
						     		<?php 
							     		if ($user->access == 1) {
							     			echo '<i class="fas fa-crown"></i> Fondateur';
							     		}
						     			elseif ($user->access == 2) 
						     			{
						     				echo 'Contributeur';
						     			}
						     			elseif ($user->access == 3)
						     			{
						     				echo 'Observateur';
						     			}
						     		?>
						     	</td>
						     	<?php 
						     		endif; 
						     		if ($user->username != $userData->username()):
						     	?>

						     	<td class="align-middle text-center" style="width: 130px">
						     		<a href="../../newConversation?user=<?= $user->id_user ?>" class="btn btn-light rounded-circle" title="Envoyer un message" data-toggle="tooltip">
						     			<i class="fas fa-envelope"></i>
						     		</a>
						     	</td>

						     	<?php 
						     		else:
						     			echo '<td class="align-middle text-center"></td>';
						     		endif;
						     	 ?>
						    </tr>
							<?php endforeach; ?>
						</table>
					</div>
					<?php if ($access->access <= 1): ?> 
					<br>
					<div>
						<button class="btn btn-dark button-edit-user-status btn_small">Modifier les status utilisateurs ?</button>
						<p class="hidden text-edit-user-status font-italic">Vous pouvez maintenant gérer les utilisateurs du projet</p>
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