// Script de chargement de l'image de fond pour l'accueil public
$(document).ready(function() {
	$('.loading_home').fadeOut(function() {
		$('.loading_home').removeClass('d-flex').removeClass('justify-content-center').removeClass('align-items-center');
		$('.background_header').animate({ opacity: 1 }, { duration: 500 });
	});
});