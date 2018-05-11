<?php 
	require_once('initRessources.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
   	<?php 
   		echo '<title>' . $title . '</title>';
   		echo $meta;
		echo $linkBootstrapCSS; 
		echo $linkFontAwesome;
		echo $linkGoogleFont;
		echo $stylesheet;
		echo $favicon;
	?>
	<link rel="stylesheet" href="./public/css/hamburger.css">
	 <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	
</head>

<body>

	<header>
		<nav class="navbar navbar-light navbar_private fixed-top">
  			<div class="container-fluid">
  				<div>
  					<button id="sidebarCollapse" class="hamburger hamburger--slider" type="button">
						<span class="hamburger-box">
						    <span class="hamburger-inner"></span>
						</span>
					</button>
	    			<a class="navbar-brand logoDashboard" href="dashboard">ONE TO DO</a>
  				</div>
    			<ul class="nav navbar-right">
    				<li class="nav-item" title="Créer un nouveau projet">
    					<a href="#">
    						<i class="fas fa-plus"></i>
    					</a>
    				</li>
    				<li class="nav-item text-center" title="Voir les messages">
    					<a href="#">
	    					<span class="fa-layers">
	    						<i class="fas fa-envelope"></i>
	    						<span class="fa-layers-counter">5</span>
	  						</span>
  						</a>
    				</li>
					<li class="nav-item dropdown">
					  	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Options profil">
          					<i class="fas fa-user-circle"></i>
        				</a>
        				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				          	<a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Paramètres</a>
				          	<a class="dropdown-item" href="./"><i class="fas fa-power-off"></i> Déconnexion</a>
				        </div>
        			</li>
    			</ul>
  			</div>
		</nav>
	</header>

	<div class="wrapper">
		<nav id="sidebar"class="active">
	        <div class="sidebar-header">
	            <h3>Tableau de bord</h3>
	        </div>
	        <ul class="list-unstyled components">
	            <li>
	                <a href="#myProject" data-toggle="collapse" aria-expanded="false" class="activeCollapse">
		                &nbsp;<i class="fas fa-caret-down rotate"></i>&nbsp;&nbsp;&nbsp;Vos projets 
		            </a>
	                <ul class="collapse" id="myProject">
	                    <li><a href="#">Projet 1</a></li>
	                    <li><a href="#">Projet 2</a></li>
	                    <li><a href="#">Projet 3</a></li>
	                </ul>
	            </li>
	            <li>
	                <a href="#contributeProject" data-toggle="collapse" aria-expanded="false" class="activeCollapse">
		                &nbsp;<i class="fas fa-caret-down rotate"></i>&nbsp;&nbsp;&nbsp;Contributeur 
		            </a>
	                <ul class="collapse" id="contributeProject">
	                    <li><a href="#">Projet 4</a></li>
	                    <li><a href="#">Projet 5</a></li>
	                    <li><a href="#">Projet 6</a></li>
	                </ul>
	            </li>
	            <li>
	                <a href="#watchProject" data-toggle="collapse" aria-expanded="false" class="activeCollapse">
	                	&nbsp;<i class="fas fa-caret-down rotate"></i>&nbsp;&nbsp;&nbsp;Observateur 
	                </a>
	                <ul class="collapse" id="watchProject">
	                    <li><a href="#">Projet 7</a></li>
	                    <li><a href="#">Projet 8</a></li>
	                    <li><a href="#">Projet 9</a></li>
	                </ul>
	            </li>
	        </ul>
	    </nav>

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

		// Call to JavaScript scripts
		// provoquer un conflit au niveau des link des collapses
		// echo $scriptScroll;
		echo $scriptAlert;
		echo $scriptGlobal;
	?>
<!-- Custom Scroller Js CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>


	<script>
		
	 $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#sidebarCollapse').on('click', function () {
        	$('#sidebarCollapse').toggleClass('is-active');
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });

        $(".activeCollapse").on('click', function(){
			$('.rotate', this).toggleClass("down"); 
		});
    });


	</script>


</body>
</html>