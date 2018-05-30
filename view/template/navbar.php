<header>
		<nav class="navbar navbar-light navbar_private fixed-top">
  			<div class="container-fluid">
  				<div>
  					<button id="sidebarCollapse" class="hamburger hamburger--slider is-active" type="button">
						<span class="hamburger-box">
						    <span class="hamburger-inner"></span>
						</span>
					</button>
	    			<a class="navbar-brand logoDashboard" href="<?= \App\model\App::getDomainPath() ?>/dashboard">ONE TO DO</a>
  				</div>
    			<ul class="nav navbar-right">
    				<li class="nav-item icon-navbar" title="Créer un nouveau projet" data-toggle="tooltip" data-placement="bottom">
    					<a href="<?= \App\model\App::getDomainPath() ?>/nouveauProjet">
    						<i class="fas fa-plus icon_plus"></i>
    					</a>
    				</li>
    				<li class="nav-item text-center icon-navbar" title="Voir les messages" data-toggle="tooltip" data-placement="bottom">
    					<a href="<?= \App\model\App::getDomainPath() ?>/messagerie">
	    					<span class="fa-layers fa-fw">
	    						<i class="fas fa-envelope"></i>
	    						<?php 
	    							if ($notSeenMessage > 0)
	    							{
	    								echo '<span class="fa-layers-counter">' . $notSeenMessage . '</span>';
	    							} 
	    						?>	
	  						</span>
  						</a>
    				</li>
					<li class="nav-item dropdown icon-navbar">
					  	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Options profil"> 
          					<?= $avatar->generateGravatar() ?>
        				</a>
        				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				          	<a class="dropdown-item" href="<?= \App\model\App::getDomainPath() ?>/parametres"><i class="fas fa-cog"></i> Paramètres</a>
				          	<a class="dropdown-item" href="<?= \App\model\App::getDomainPath() ?>/disconnect"><i class="fas fa-power-off"></i> Déconnexion</a>
				        </div>
        			</li>
    			</ul>
  			</div>
		</nav>
	</header>