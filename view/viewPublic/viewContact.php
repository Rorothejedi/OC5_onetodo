<?php 
	$title = 'Contact';
	ob_start();
?>
	</header>

	<section class="section_connection">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<h1>Contact</h1>
					<p>Pour nous contacter, quel que soit votre demande, vous pouvez remplir le formulaire de contact ci-dessous. <br> Nous vous répondrons à l'adresse email que vous avez renseignée le plus vite possible.</p>
					<form action="processContact" method="POST">
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="email" class="form-control" name="email" required>
						</div>
						<div class="form-group">
							<label for="subject">Sujet</label>
							<input id="subject" type="text" class="form-control" name="subject" required>
						</div>
						<div class="form-group">
							<label for="message">Message</label>
							<textarea id="message" class="form-control" name="message" rows="7" required></textarea>
						</div>
						<div class="form-group">
							<div id="captcha" class="g-recaptcha" data-sitekey="6Le4tVoUAAAAAI3c1XgIrRRfKafJwe1yFDYFoglI"></div>
						</div>
						<button type="submit" class="btn btn-primary btn-block btn-lg btn-submit">Envoyer</button>
					</form>
				</div>
			</div>
		</div>
	</section>


<?php 
	$content = ob_get_clean();
	require('./view/template/templatePublic.php');
?>