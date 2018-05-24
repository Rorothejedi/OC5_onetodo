<?php 
	$title = 'OneToDo | Messagerie (conversation)';
	ob_start();
?>

	<div class="container-fluid">
		<nav aria-label="breadcrumb">
  			<ol class="breadcrumb">
    			<li class="breadcrumb-item"><a href="dashboard">Tableau de bord</a></li>
    			<li class="breadcrumb-item active"><a href="../messagerie">Messagerie</a></li>
    			<li class="breadcrumb-item active" aria-current="Discussion privée">Discussion</li>
  			</ol>
		</nav>
		<br>
		<div class="row">
			<div class="col-lg-9">
				<div class="jumbotron messages_content">
					<div class="page-header">
						<div>
							<h5>Votre discussion avec <strong>Username</strong></h5>
						</div>
						<hr class="begin_flux">
					</div>
					<!-- nouveau message -->
					<div class="d-flex">
						<div>
							<i class="fas fa-user-circle fa-3x"></i>
						</div>
						<div class="text_conversation_title flux_message">
							<div>
								<small class="text-muted"><strong>Username</strong></small>
							</div>
							<div class="flux_message_left rounded">
								<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur deserunt nemo dicta voluptatibus atque officiis at labore non et sed, unde illum, similique quis fugit esse adipisci eveniet velit nesciunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum expedita reiciendis veniam blanditiis porro, officia eum, consequuntur quaerat voluptates quae laborum magni distinctio praesentium magnam, sunt voluptatibus reprehenderit culpa minima!</span>
								<div>
									<small class="text-muted">22/08/98 - 12h13</small>
								</div>
							</div>
						</div>
					</div>
					<!-- fin message -->
					<!-- nouveau message -->
					<div class="d-flex new_message justify-content-end">
						<div class="flux_message message_right">
							<div class="text-right">
								<small class="text-muted"><strong>Vous</strong></small>
							</div>
							<div class="flux_message_right rounded">
								<span>Ok</span>
								<div class="text-right">
									<small class="text-muted">22/08/02 - 15h58</small>
								</div>
							</div>
						</div>
						<div>
							<i class="fas fa-user-circle fa-3x"></i>
						</div>
					</div>
					<!-- fin message -->
					<!-- nouveau message -->
					<div class="d-flex new_message justify-content-end">
						<div class="flux_message message_right">
							<!-- A cacher si deux mesasges de suite sont posté par le même utilisateur -->
							<div class="text-right">
								<small class="text-muted"><strong>Vous</strong></small>
							</div>
							<div class="flux_message_right rounded">
								<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur deserunt nemo dicta voluptatibus atque officiis at labore non et sed, unde illum, similique quis fugit esse adipisci eveniet velit nesciunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
								<div class="text-right">
									<small class="text-muted">22/08/02 - 15h58</small>
								</div>
							</div>
						</div>
						<div>
							<i class="fas fa-user-circle fa-3x"></i>
						</div>
					</div>
					<!-- fin message -->
					<div>
						<hr>
						<form action="" method="POST" id="formUserMessage">
							<div class="form-group d-flex align-items-end input_new_message">
								<textarea name="" id="userMessage" rows="2" class="form-control" placeholder="Votre message..."></textarea>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php require('viewMessagingContact.php'); ?>
		</div>
	</div>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
 ?>