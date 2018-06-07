<?php 
    $link = explode('/', $_GET['url']);

	$myProjectContent         = false;
	$contributeProjectContent = false;
	$watchProjectContent      = false;

    $myProjectContentCount         = 0;
    $contributeProjectContentCount = 0;
    $watchProjectContentCount      = 0;

    $arr_length = count($projects);
	for ($i = 0; $i < $arr_length; $i++) 
	{ 
		if ($projects[$i]->access == 1)
		{
			$myProjectContent = true;
            $myProjectContentCount++;
		}
		elseif ($projects[$i]->access == 2) 
		{
			$contributeProjectContent = true;
            $contributeProjectContentCount++;
		}
		elseif ($projects[$i]->access == 3) 
		{
			$watchProjectContent = true;
            $watchProjectContentCount++;
		}
	} 
 ?>


<nav id="sidebar">
    <ul class="list-unstyled components">
    	
    	<li class="home-button" style="<?php if ($link[0] == 'dashboard') {echo "background-color: white; border-bottom-left-radius: 1rem";} ?>">
    		<a href="<?= \App\model\App::getDomainPath() ?>/dashboard" style="<?php if ($link[0] == 'dashboard') {echo "color: var(--second-color)";} ?>">Tableau de bord</a>
            <hr>
    	</li>	

    	<?php if ($myProjectContent === true): ?>

        <li>
            <a href="#myProject" data-toggle="collapse" aria-expanded="<?php if($myProjectContentCount <= 7){echo 'true';}else{echo 'false';} ?>" class="activeCollapse justify-content-between d-flex">
                Vos projets <i class="fas fa-caret-down rotate <?php if($myProjectContentCount <= 7){echo 'down';} ?>"></i>
            </a>
            <ul class="collapse <?php if($myProjectContentCount <= 7){echo 'show';} ?>" id="myProject">

            	<?php 
					foreach ($projects as $key => $project): 
						if ($project->access == 1):
				?>

                <li>
                    <a href="<?= \App\model\App::getDomainPath() . '/projet/' . $project->link . '/home' ?>" class="rounded-left projectColorLink <?php if(isset($link[1]) && $project->link == $link[1]){echo'activeProject';} ?>">
                        <?= $project->name ?>
                    </a>
                </li>
    
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
            <a href="#contributeProject" data-toggle="collapse" aria-expanded="<?php if($contributeProjectContentCount <= 5){echo 'true';}else{echo 'false';} ?>" class="activeCollapse justify-content-between d-flex">
                Contributeurs <i class="fas fa-caret-down rotate <?php if($contributeProjectContentCount <= 5){echo 'down';} ?>"></i>
            </a>
            <ul class="collapse <?php if($contributeProjectContentCount <= 5){echo 'show';} ?>" id="contributeProject">

               <?php 
					foreach ($projects as $key => $project): 
						if ($project->access == 2):
				?>

                <li>
                    <a href="<?= \App\model\App::getDomainPath() . '/projet/' . $project->link . '/home' ?>" class="rounded-left projectColorLink <?php if(isset($link[1]) && $project->link == $link[1]){echo'activeProject';} ?>">
                        <?= $project->name ?>
                    </a>
                </li>

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
            <a href="#watchProject" data-toggle="collapse" aria-expanded="<?php if($watchProjectContentCount <= 5){echo 'true';}else{echo 'false';} ?>" class="activeCollapse justify-content-between d-flex">
            	Observateurs <i class="fas fa-caret-down rotate <?php if($watchProjectContentCount <= 5){echo 'down';} ?>"></i>
            </a>
            <ul class="collapse <?php if($watchProjectContentCount <= 5){echo 'show';} ?>" id="watchProject">

                <?php 
					foreach ($projects as $key => $project): 
						if ($project->access == 3):
				?>

                <li>
                    <a href="<?= \App\model\App::getDomainPath() . '/projet/' . $project->link . '/home' ?>" class="rounded-left projectColorLink <?php if(isset($link[1]) && $project->link == $link[1]){echo'activeProject';} ?>">
                        <?= $project->name ?>
                    </a>
                </li>

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