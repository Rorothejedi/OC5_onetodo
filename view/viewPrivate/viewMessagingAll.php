<?php 
	$title = 'OneToDo | Messagerie (conversation)';
	ob_start();
?>

	<div class="container-fluid">
		<nav aria-label="breadcrumb">
  			<ol class="breadcrumb">
    			<li class="breadcrumb-item"><a href="../dashboard">Tableau de bord</a></li>
    			<li class="breadcrumb-item active" aria-current="Messagerie privée">Messagerie</li>
  			</ol>
		</nav>
		<br>
		<div class="row">
			<div class="col-lg-9">
				<div class="jumbotron messages_content">
					<div class="page-header">
						<div>
							<h5>Toutes les discussions</h5>
						</div>
						<div class="text-right">
							<a href="../messagerie" class="small">Voir les messages non lus</a>
						</div>
						<hr>
					</div>
					<!-- Message -->
					<a href="#">
						<div class="conversation_title d-flex rounded">
							<div class="img_conversation_title">
								<i class="fas fa-user-circle fa-3x img_user_message"></i>
							</div>
							<div class="text_conversation_title">
								<div class="d-flex justify-content-between">
									<strong>Username</strong>
									<small class="text-muted">22/08/98 à 12h13</small>
								</div>
								<div>
									<span class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur deserunt nemo dicta voluptatibus atque officiis at labore non et sed, unde illum, similique quis fugit esse adipisci eveniet velit nesciunt.</span>
								</div>
							</div>
						</div>
					</a>
					<!-- end message -->
					<!-- Message -->
					<a href="#">
						<div class="conversation_title d-flex rounded">
							<div class="img_conversation_title">
								<i class="fas fa-user-circle fa-3x img_user_message"></i>
							</div>
							<div class="text_conversation_title">
								<div class="d-flex justify-content-between">
									<strong>test user</strong>
									<small class="text-muted">22/08/98 à 12h13</small>
								</div>
								<div>
									<span class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam eum voluptates, modi quae excepturi, suscipit dolor saepe, autem ipsum expedita harum praesentium facere, vel in iusto. Ipsum deleniti amet doloribus.</span>
								</div>
							</div>
						</div>
					</a>
					<!-- end message -->
					<!-- Message -->
					<a href="#">
						<div class="conversation_title d-flex rounded">
							<div class="img_conversation_title">
								<i class="fas fa-user-circle fa-3x img_user_message"></i>
							</div>
							<div class="text_conversation_title">
								<div class="d-flex justify-content-between">
									<strong>Username</strong>
									<small class="text-muted">22/08/98 à 12h13</small>
								</div>
								<div>
									<span class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur deserunt nemo dicta voluptatibus atque officiis at labore non et sed, unde illum, similique quis fugit esse adipisci eveniet velit nesciunt.</span>
								</div>
							</div>
						</div>
					</a>
					<!-- end message -->
					<!-- Message -->
					<a href="#">
						<div class="conversation_title d-flex rounded">
							<div class="img_conversation_title">
								<i class="fas fa-user-circle fa-3x img_user_message"></i>
							</div>
							<div class="text_conversation_title">
								<div class="d-flex justify-content-between">
									<strong>Username</strong>
									<small class="text-muted">22/08/98 à 12h13</small>
								</div>
								<div>
									<span class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur deserunt nemo dicta voluptatibus atque officiis at labore non et sed, unde illum, similique quis fugit esse adipisci eveniet velit nesciunt.</span>
								</div>
							</div>
						</div>
					</a>
					<!-- end message -->
					<!-- Message -->
					<a href="#">
						<div class="conversation_title d-flex rounded">
							<div class="img_conversation_title">
								<i class="fas fa-user-circle fa-3x img_user_message"></i>
							</div>
							<div class="text_conversation_title">
								<div class="d-flex justify-content-between">
									<strong>Username</strong>
									<small class="text-muted">22/08/98 à 12h13</small>
								</div>
								<div>
									<span class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur deserunt nemo dicta voluptatibus atque officiis at labore non et sed, unde illum, similique quis fugit esse adipisci eveniet velit nesciunt.</span>
								</div>
							</div>
						</div>
					</a>
					<!-- end message -->
				</div>
			</div>
			<?php require('viewMessagingContact.php'); ?>
		</div>
	</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
 ?>

				
			