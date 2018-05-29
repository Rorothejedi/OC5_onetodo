<?php 
	$title = 'OneToDo | Messagerie (conversation)';
	ob_start();
?>

	<div class="container-fluid">
		<nav aria-label="breadcrumb">
  			<ol class="breadcrumb">
    			<li class="breadcrumb-item"><a href="../dashboard">Tableau de bord</a></li>
    			<li class="breadcrumb-item active"><a href="../messagerie">Messagerie</a></li>
    			<li class="breadcrumb-item active" aria-current="Conversation privée">Conversation</li>
  			</ol>
		</nav>
		<br>
		<div class="row">
			<div class="col-lg-9">
				<div class="jumbotron messages_content">
					<div class="page-header">
						
					<?php if (count($users_conversation) == 0): ?>
					
						<div>
							<h5>Débuter une conversation</h5>
						</div>
						<hr class="begin_flux">
						<p>Pour démarrer cette conversation, vous devez y <strong>inviter au moins une personne !</strong></p>
						<br>
					</div>

					<?php else: ?>
						
						<div>
							<h5>Votre conversation avec
							<?php 
								$conversation_name = ' ';
								foreach ($users_conversation as $key => $user) 
								{
									$conversation_name .= '<strong>' . $user->username . '</strong>, ';
								} 
								echo substr($conversation_name, 0, -2);
							?>
							</h5>
						</div>
						<hr class="begin_flux">
					</div>

					<?php 
						endif; 
						if (count($conversation) == 0 && count($users_conversation) > 0) 
						{
							echo '<p class="text-muted font-italic">Soyez le premier à débuter cette conversation !</p><br>';
						}
						foreach ($conversation as $key => $message): 
							if ($message->id_user == $_SESSION['user_id']):
					?>

					<!--my message -->
					<div class="d-flex new_message justify-content-end">
						<div class="flux_message message_right">
							<div class="text-right">
								<?php 
									if (isset($conversation[$key - 1]) && ($message->email == $conversation[$key - 1]->email)) {}else
									{
										echo '<small class="text-muted"><strong>Vous</strong></small>';
									}
								?>
							</div>
							<div class="flux_message_right rounded">
								<span><?= $message->content ?></span>
								<div class="text-right">
									<small class="text-muted"><?= $message->date_reception ?></small>
								</div>
							</div>
						</div>
						<div class="d-flex align-items-center">
							<?php 
								if (isset($conversation[$key - 1]) && ($message->email == $conversation[$key - 1]->email)) 
								{
									echo "<span class='user_fill_in_right'></span>";
								}
								else
								{
									$avatar = new \App\model\Avatar($message->email, 50); 
									echo $avatar->generateGravatar();
								}
							?>
						</div>
					</div>
					<!-- end my message -->

					<?php else: ?>

					<!-- message -->
					<div class="d-flex new_message">
						<div class="d-flex align-items-center">
							<?php 
								if (isset($conversation[$key - 1]) && ($message->email == $conversation[$key - 1]->email)) 
								{
									echo "<span class='user_fill_in_left'></span>";
								}
								else
								{
									$avatar = new \App\model\Avatar($message->email, 50); 
									echo $avatar->generateGravatar();
								}
							?>
						</div>
						<div class="flux_message message_left">
							<div>
								<?php 
									if (isset($conversation[$key - 1]) && ($message->email == $conversation[$key - 1]->email)) {}else
									{
										echo '<small class="text-muted"><strong>' . $message->username . '</strong></small>';
									}
								?>
							</div>
							<div class="flux_message_left rounded">
								<span><?= $message->content ?></span>
								<div>
									<small class="text-muted"><?= $message->date_reception ?></small>
								</div>
							</div>
						</div>
					</div>
					<!-- end message -->

					<?php 
							endif;
						endforeach; 
					?>
					
					<div>
						<hr>
						<form action="../processNewMessage" method="POST" id="formUserMessage">
							<div class="d-flex align-items-end input_new_message">
								<textarea name="content" id="userMessage" class="form-control" placeholder="Votre message..." style="resize: none;" <?php if(count($users_conversation) == 0){echo 'readonly';} ?>></textarea>
								<input type="hidden" name="conv" value="<?= $_GET['conv'] ?>">
								<div>
									<button class="d-flex btn btn-primary" title="Poster votre message">OK</button>
									<button type="button" class="btn btn-secondary text-center" style="width: 100%" value="Refresh Page" onclick="window.location.href=window.location.href" title="Rafraîchir la conversation">
										<i class="fas fa-redo"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Contacts -->
			<div class="col-lg-3">
				<div class="jumbotron messages_content">
					<div class="page-header">
						<h5>Ajouter à la conversation</h5>
						<hr>
					</div>
					<form action="../addUserConversation" method="GET">
						<div class="input-group">
							<input name='user' type="text" placeholder="Un utilisateur..." aria-label="Rechercher un utilisateur" class="form-control">
							<input type="hidden" name="conv" value="<?= $_GET['conv'] ?>">
							<div class="input-group-append">
							    <button class="btn btn-dark" type="submit"><i class="fas fa-plus"></i></button>
							</div>
						</div>
					</form>
					<hr>
					<p class="small text-muted font-italic">Ou un de vos contact favoris...</p>
	
					<!-- User -->
					<?php foreach ($main_contact_add as $key => $contact): ?>
					<a href="../addUserConversation?conv=<?= $_GET['conv'] ?>&user=<?= $contact->id_user ?>">
						<div class="d-flex align-items-center conversation_title rounded">
							<div>
								<i class="fas fa-plus icon_add_user"></i>
							</div>
							<div class="d-flex">
								<div class="img_conversation_title">
									<?php 
										$avatar = new \App\model\Avatar($contact->email, 50); 
										echo $avatar->generateGravatar();
									?>
								</div>
								<div class="vertical_center">
									<p class="text_username_contact"><strong><?= $contact->username ?></strong></p>
								</div>
							</div>
						</div>
					</a>
					<?php endforeach; ?>
					<!-- endUser -->
				</div>
			</div>
		</div>
	</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
?>