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
		echo $linkGoogleFont;
		echo $linkCustomScrollbar;
		echo $stylesheet;
		echo $favicon;
	?>
</head>

<body>

	<header>
		<nav class="navbar navbar-light navbar_private fixed-top">
  			<div class="container-fluid">
  				<div>
  					<button id="sidebarCollapse" class="hamburger hamburger--slider is-active" type="button">
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
	    					<span class="fa-layers fa-fw">
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
				          	<a class="dropdown-item" href="disconnect"><i class="fas fa-power-off"></i> Déconnexion</a>
				        </div>
        			</li>
    			</ul>
  			</div>
		</nav>
	</header>

	<div class="wrapper">
		<nav id="sidebar">
	        <ul class="list-unstyled components">
	        	<hr>
	        	<li>
	        		<a href="dashboard"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Tableau de bord</a>
	        	</li>
	        	<hr>
	            <li>
	                <a href="#myProject" data-toggle="collapse" aria-expanded="false" class="activeCollapse justify-content-between d-flex">
		                Vos projets <i class="fas fa-caret-down rotate"></i>
		            </a>
	                <ul class="collapse" id="myProject">
	                    <li><a href="#" class="rounded-left">Projet 1</a></li>
	                    <li><a href="#" class="rounded-left">Projet 2</a></li>
	                    <li><a href="#" class="rounded-left">Projet 3</a></li>
	                </ul>
	            </li>
	            <li>
	                <a href="#contributeProject" data-toggle="collapse" aria-expanded="false" class="activeCollapse justify-content-between d-flex">
		                Contributeurs <i class="fas fa-caret-down rotate"></i>
		            </a>
	                <ul class="collapse" id="contributeProject">
	                    <li><a href="#" class="rounded-left">Projet 4</a></li>
	                    <li><a href="#" class="rounded-left">Projet 5</a></li>
	                    <li><a href="#" class="rounded-left">Projet 6</a></li>
	                </ul>
	            </li>
	            <li>
	                <a href="#watchProject" data-toggle="collapse" aria-expanded="false" class="activeCollapse justify-content-between d-flex">
	                	Observateurs <i class="fas fa-caret-down rotate"></i>
	                </a>
	                <ul class="collapse" id="watchProject">
	                    <li><a href="#" class="rounded-left">Projet 7</a></li>
	                    <li><a href="#" class="rounded-left">Projet 8</a></li>
	                    <li><a href="#" class="rounded-left">Projet 9</a></li>
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
		echo $cdnCustomScrollbar;
		echo $cdnFontAwesomeJs;

		// Call to JavaScript scripts
		echo $scriptScroll; 
		echo $scriptAlert;
		echo $scriptGlobal;
		echo $scriptSidebar;
	?>

</body>
</html>