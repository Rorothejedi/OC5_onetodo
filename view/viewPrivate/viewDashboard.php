<?php 
	$title = 'OneToDo | Tableau de bord';
	ob_start();
?>
<br><br>
	<div class="container-fluid">
		<!-- Your projects -->
		<a href="#myProjectContent" data-toggle="collapse" aria-expanded="false" class="activeCollapse">
		    <h2 class="justify-content-between d-flex title_content">Vos projets <i class="fas fa-caret-down rotate down"></i></h2>
		</a>
		<hr>
		<div class="row collapse show" id="myProjectContent">
			<div class="col-lg-3 tiles_project ">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 1
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
			<div class="col-lg-3 tiles_project">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 2
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
			<div class="col-lg-3 tiles_project">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 3
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
			<div class="col-lg-3 tiles_project">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 4
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
			<div class="col-lg-3 tiles_project">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 5
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
			<div class="col-lg-3 tiles_project">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 6
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
		</div>

		<!-- Your contribute projects -->
		<a href="#contributeProjectContent" data-toggle="collapse" aria-expanded="false" class="activeCollapse">
		    <h2 class="justify-content-between d-flex title_content">Contributeur <i class="fas fa-caret-down rotate down"></i></h2>
		</a>
		<hr>
		<div class="row collapse show" id="contributeProjectContent">
			<div class="col-lg-3 tiles_project ">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 7
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
			<div class="col-lg-3 tiles_project ">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 8
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
			<div class="col-lg-3 tiles_project ">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 9
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
		</div>

		<!-- Your contribute projects -->
		<a href="#watchProjectContent" data-toggle="collapse" aria-expanded="false" class="activeCollapse">
		    <h2 class="justify-content-between d-flex title_content">Observateur <i class="fas fa-caret-down rotate down"></i></h2>
		</a>
		<hr>
		<div class="row collapse show" id="watchProjectContent">
			<div class="col-lg-3 tiles_project ">
				<a href="#">
					<div class="card">
	  					<div class="card-header">
	  						Projet 10
	  					</div>
	  					<div class="card-body">
	  						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid iste aspernatur repellendus quis earum quia repudiandae fugiat nostrum delectus, consequuntur.
	  					</div>
	  				</div>
  				</a>
			</div>
		</div>


	</div>



<?php 
	$content = ob_get_clean();
	require('./view/template/templatePrivate.php');
?>