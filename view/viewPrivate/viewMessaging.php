<?php 
	$title = 'Messagerie';
	ob_start();
?>

	<div class="container-fluid">
		<nav aria-label="breadcrumb">
  			<ol class="breadcrumb">
    			<li class="breadcrumb-item"><a href="dashboard">Tableau de bord</a></li>
    			<li class="breadcrumb-item active" aria-current="page">Messagerie</li>
  			</ol>
		</nav>
		<br>
		<div class="row">
			<div class="col-xl-9">
				<div class="jumbotron">
					<div class="page-header">
						<div>
							<h5>Toutes vos conversations</h5>
						</div>
						<hr>
					</div>
					<?php 

						if (count($conversations) == 0) 
						{
							echo '<p class="text-muted font-italic">Démarrez dès maintenant <a href="newConversation">une nouvelle conversation</a> !</p>';
						}
					 ?>
					
					<?php foreach ($conversations as $key => $conversation): 
						$usernames = $messageManager->getUsersConversations($conversation->id_conversation, $_SESSION['user_id']);
					?>
					<!-- Message -->
					<a href="messagerie/talk?conv=<?= $conversation->id_conversation ?>" class="link_message">
						<div class="conversation_title d-flex rounded <?php if($conversation->seen < 1){echo 'table-warning';} ?>">
							<div class="img_conversation_title">
								<?php 
									$avatar = new \App\model\Avatar($conversation->email, 50); 
									echo $avatar->generateGravatar();
								?>
							</div>
							<div class="text_conversation_title">
								<div class="d-flex justify-content-between">
									<div>
										<?php 
											$name = '';
											foreach ($usernames as $key => $username) 
											{
												$name .= "<strong>" . $username->username . "</strong> | ";
											} 
											echo substr($name, 0, -2);
										?>
									</div>
									<small class="text-muted d-none d-sm-block"><?= $conversation->date_reception ?></small>
								</div>
								<div class="d-flex justify-content-between">
									<span class="text-muted">
										<?php 
											if ($conversation->username == $_SESSION['user_username']) 
											{
												echo "Vous : " . $conversation->content;
											} 
											else 
											{
												echo $conversation->username . ' : ' . $conversation->content;
											} 
										?>
									</span>
									<a href="deleteUserConversation?conv=<?= $conversation->id_conversation ?>" data-confirm="Etes-vous certain de vouloir vous retirer de cette conversation ?" class="d-none d-sm-block delete_conversation_icon text-muted" data-toggle="tooltip" data-placement="left" data-trigger="hover" title="Se retirer de la conversation">
										<i class="fas fa-times-circle"></i>
									</a>
								</div>
							</div>
						</div>
					</a>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-xl-3">
				<a href="newConversation" class="text-center">
					<div class="jumbotron messages_content new_conversation_button">
						<h5>Nouvelle conversation <i class="fas fa-plus-square"></i></h5>
					</div>
				</a>
				<div class="jumbotron messages_content">
					<h5>Contacts favoris</h5>
					<hr>
					<p class="small text-muted">Démarrez une nouvelle conversation avec vos contacts les plus fréquents...</p>
					<?php foreach ($contacts as $key => $contact): ?>
					<a href="newConversation?user=<?= $contact->id_user ?>">
						<div class="conversation_title d-flex rounded">
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
					</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
?>	