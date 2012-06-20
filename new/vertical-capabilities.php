<?PHP require 'functions/vertical_capabilities_inc.php'; ?>
<?PHP include "includes-fe/$beginphp"; ?>


<body>

<?PHP include "includes-fe/global-nav.php"; ?>

<!--headline-->
<div class="container banner short"><div class="row">
	<div class="three columns art-left hide-on-phones" style="background-image: url(<?php	
                        if ($service_main ['service_main_image'] != null) {
							print "user_images/".$service_main ['service_main_image'];
						} else {
							print "images/spot_service_server.png";
						}
						?>);">&nbsp;</div>
	<div class="seven columns pull-two">
		<ul class="breadcrumbs clearfix">
			<li><a href="index.php">Home</a></li>
			<li><a href="vertical.php?vertical=<?php print $sector_id;?>"><?php print $service_main['main_title'];?></a></li>
		</ul>
		<h1><?php print $service_main['service_title'];?></h1>
	</div>
</div></div><!--/headline-->

<!--main body of page-->
<div class="container">
	<div class="row">

		<article role="main" class="six columns push-three">

			<ol class="contents thumbs">
			<?php foreach($sector_capabilities as $c){?>
				<li>
					<a href="vertical-capability.php"><img src="<?php	
                        if ($c ['filename'] != null) {
							print "user_images/".$c ['filename'];
						} else {
							print "images/spot_service_server.png";
						}
						?>" alt="spot_service_server" /></a>
					<div class="item">
						<a href="vertical-capability.php?vertical=<?php print $sector_id?>&id=<?php print $c['service_id']?>"><?php print $c['name']?></a>
						<span class="snippet"><?php print $c['slug']?></span>
					</div><!--/item-->
				</li>
			<?php }?>
			</ol>		

		</article>

	<!--local nav-->		
		<nav role="navigation" class="three columns pull-six">
			<ul class="category">
				<li><a href="vertical.php?vertical=<?php print $sector_id;?>">Overview</a></li>
				<li class="active"><a href="vertical-capabilities.php?vertical=<?php print $sector_id;?>">Capabilities</a></li>
				<li><a href="vertical-insights.php?vertical=<?php print $sector_id;?>">Latest Insights</a></li>
				<li><a href="vertical-team.php?vertical=<?php print $sector_id;?>">Team</a></li>
				<li class="show-on-phones"><a href="contact-service.php">Contact Us</a></li>
			</ul>		
		</nav>

		
	<!--sidebar content-->		
		<aside role="complementary" class="three columns hide-on-phones">			

			<?PHP include "includes-fe/aside-events.php"; ?>

			<?PHP include "includes-fe/aside-insights.php"; ?>

		</aside>

	</div><!--/mainbody-->
	
<?PHP include "includes-fe/footer.php"; ?>

</div><!--/container-->

<?PHP include "includes-fe/end.php"; ?>