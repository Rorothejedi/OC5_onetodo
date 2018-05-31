<?php 

	$myProjectContent         = false;
	$contributeProjectContent = false;
	$watchProjectContent      = false;

	for ($i = 0; $i < count($projects); $i++) 
	{ 
		if ($projects[$i]->access == 1)
		{
			$myProjectContent = true;
		}
		elseif ($projects[$i]->access == 2) 
		{
			$contributeProjectContent = true;
		}
		elseif ($projects[$i]->access == 3) 
		{
			$watchProjectContent = true;
		}
	} 

 ?>


<nav id="sidebar">
    <ul class="list-unstyled components">
    	
    	<li class="home-button">
    		<a href="<?= \App\model\App::getDomainPath() ?>/dashboard"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Tableau de bord</a>
            <hr>
    	</li>
    	

    	<?php if ($myProjectContent === true): ?>

        <li>
            <a href="#myProject" data-toggle="collapse" aria-expanded="false" class="activeCollapse justify-content-between d-flex">
                Vos projets <i class="fas fa-caret-down rotate"></i>
            </a>
            <ul class="collapse" id="myProject">

            	<?php 
					foreach ($projects as $key => $project): 
						if ($project->access == 1):
				?>

                <li><a href="<?= \App\model\App::getDomainPath() . '/projet/' . $project->link ?>" class="rounded-left"><?= $project->name ?></a></li>

                <?php 
						endif;
					endforeach;
				?>
            
            </ul>
        </li>

        <?php
			endif; 
			if ($contributeProjectContent === true):
		?>

        <li>
            <a href="#contributeProject" data-toggle="collapse" aria-expanded="false" class="activeCollapse justify-content-between d-flex">
                Contributeurs <i class="fas fa-caret-down rotate"></i>
            </a>
            <ul class="collapse" id="contributeProject">

               <?php 
					foreach ($projects as $key => $project): 
						if ($project->access == 2):
				?>

                <li><a href="<?= \App\model\App::getDomainPath() . '/projet/' . $project->link ?>" class="rounded-left"><?= $project->name ?></a></li>

                <?php 
						endif;
					endforeach;
				?>

            </ul>
        </li>

        <?php 
			endif; 
			if ($watchProjectContent === true):
		?>

        <li>
            <a href="#watchProject" data-toggle="collapse" aria-expanded="false" class="activeCollapse justify-content-between d-flex">
            	Observateurs <i class="fas fa-caret-down rotate"></i>
            </a>
            <ul class="collapse" id="watchProject">

                <?php 
					foreach ($projects as $key => $project): 
						if ($project->access == 3):
				?>

                <li><a href="<?= \App\model\App::getDomainPath() . '/projet/' . $project->link ?>" class="rounded-left"><?= $project->name ?></a></li>

                <?php 
						endif;
					endforeach;
				?>

            </ul>
        </li>

        <?php 
    		endif; 
    	?>

    </ul>
</nav>