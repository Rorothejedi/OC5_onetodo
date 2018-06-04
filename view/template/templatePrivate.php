<?php 
	require_once('initRessources.php');
	$avatar = new \App\model\Avatar($userData->email(), 33);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
   	<?php 
   		echo '<title>' . $title . '</title>';
   		echo $meta;
		echo $linkBootstrapCSS; 
		echo $linkGoogleFont;
		echo $linkCustomScrollbar;
		echo $stylesheet;
		echo $favicon;
	?>
</head>

<body>

	<?php require('navbar.php'); ?>

	<div class="wrapper">
		<?php require('sidebar.php'); ?>
	    <section id="content">
	       <?= $content ?>
	    </section>
	</div>

	<?php
		include('alerts.php');
		// Call to CDN
		echo $cdnJQuery;
		echo $cdnPopper;
		echo $cdnBoostrap;
		echo $cdnCustomScrollbar;
		echo $cdnFontAwesomeJs;

		// Call to JavaScript scripts
		echo $scriptAlert;
		echo $scriptGlobal;
		echo $scriptSidebar;
		echo $scriptConfirm;
		echo $scriptInputChecking;
		echo $scriptTooltip;
		echo $scriptTextarea;
		echo $scriptProjectDescription;
	?>

	<script>
		// Script permettant le fonctionnement des popovers.
		$(document).ready(function()
		{
    		$('[data-toggle="popover"]').popover();   
		});
		// Script permettant la disparition du popover en cliquant n'importe où.
		$('body').on('click', function (e) 
		{
	        if ($(e.target).data('toggle') !== 'popover'
	            && $(e.target).parents('[data-toggle="popover"]').length === 0
	            && $(e.target).parents('.popover.in').length === 0) 
	        { 
	            $('[data-toggle="popover"]').popover('hide');
	        }
	    });
		
		// Script permettant l'ouverture et la fermuture de la div contenant le select pour les accès aux projets ouverts.
		$('#statusProject').change(function() 
		{
			var value = $("#statusProject option:selected").val();
			if (value == 1) 
			{
				$('.block-open-project').slideDown();
				$('#openProject').attr('required', 'required');
			}
			else
			{
				$('.block-open-project').slideUp();
				$('#openProject').removeAttr('required');
			}
		});


		$('.button-open-table-row').click(function() 
		{
			var id = $(this).attr("id").split('-');
	
			$('#row_table-' + id[1]).slideToggle();
			$('#block_table-' + id[1]).slideToggle();
			$('#row_table-' + id[1] + '-bis').slideToggle();
			$('#block_table-' + id[1] + '-bis').slideToggle();

			$('.row-table-more').not('#row_table-' + id[1]).not('#row_table-' + id[1] + '-bis').slideUp();
			$('.block-table-more').not('#block_table-' + id[1]).not('#block_table-' + id[1] + '-bis').slideUp();
		});

		$('.secondRow').hover(function() {
			$(this).css('background-color', '#D8DADD');
			$(this).prev().css('background-color', '#D8DADD');
			}, function(){
			$(this).prev().css('background-color', 'inherit');
			$(this).css('background-color', 'inherit');
		});

		$('.firstRow').hover(function() {
			$(this).css('background-color', '#D8DADD');
			$(this).next().css('background-color', '#D8DADD');
			}, function(){
			$(this).next().css('background-color', 'inherit');
			$(this).css('background-color', 'inherit');
		});

	</script>

</body>
</html>