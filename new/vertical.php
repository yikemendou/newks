<?PHP require 'functions/vertical_inc.php'; ?>
<?PHP include "includes-fe/$beginphp"; ?>

<body>

<?PHP include "includes-fe/global-nav.php"; ?>

<!--headline-->
<div class="container banner"><div class="row">
	<div class="three columns art-left hide-on-phones" style="background-image: url(<?php	
                        if ($sector_main ['sector_main_image'] != null) {
							print "user_images/".$sector_main ['sector_main_image'];
						} else {
							print "images/spot_service_server.png";
						}
						?>);">&nbsp;</div>
	<div class="seven columns pull-two">
		<h1><?php print $sector_main['main_title']?></h1>
		<h2><?php print $sector_main['main_intro']?></h2>
	</div>
</div></div><!--/headline-->

<!--main body of page-->
<div class="container">
	<div class="row">

		<article role="main" class="six columns push-three">
			<p><?php print $sector_main['main_body']?></p>
			
		<!--insight links within-->
			<section role="complementary" class="related hide-on-phones">
				<h4><a href="vertical-insights.php?vertical=<?php print $sector_id;?>">Latest Insights</a></h4>
				<ol class="contents thumbs three-across">
				<?php foreach($sector_insights as $in) {?>
					<li>
						<a href="vertical-insight.php?vertical=<?php print $sector_id?>&id=<?php print $in['publication_id']?>">
						<img src="images/spot_insight_cloud.png" alt="spot_insight_cloud" /></a>
						<div class="item">
							<a href="vertical-insight.php?vertical=<?php print $sector_id?>&id=<?php print $in['publication_id']?>">
							<?php print $in['publication_name']?></a>
							<span class="detail">Detail lorem ipsun dolor sit amnet nos rios dolor sit amnet nos rios dolor sit amnet nos rios det nt nos rios dolor sit amnet nos rios</span>
						</div><!--/item-->
					</li>
				<?php }?>
				</ol>		
			</section>

		<!--capability links -short- within-->
			<section role="complementary" class="related hide-on-phones">
				<h4><a href="vertical-capabilties.php?vertical=<?php print $sector_id?>">Capabilities</a></h4>
				<ol class="contents arrows">
					<?php foreach ($sector_capabilities as $c){?>
					<li><a href="vertical-capability.php?vertical=<?php print $sector_id?>&id=<?php print $c['id']?>">
					<?php print $c['name']?></a></li>
					<?php }?>
				</ol>		
			</section>
			
			<p>Through our suite of services, we help improve internal functions, rationalize and align organizations and accelerate major changes, such as the adoption of emerging, often disruptive, technologies like cloud computing.</p>
			
		</article>

	<!--local nav-->		
		<nav role="navigation" class="three columns pull-six">
			<ul class="category">
				<li class="active"><a href="vertical.php?vertical=<?php print $sector_id;?>">Overview</a></li>
				<li><a href="vertical-capabilities.php?vertical=<?php print $sector_id;?>">Capabilities</a></li>
				<li><a href="vertical-insights.php?vertical=<?php print $sector_id;?>">Latest Insights</a></li>
				<li><a href="vertical-team.php?vertical=<?php print $sector_id;?>">Team</a></li>
				<li class="show-on-phones"><a href="contact-service.php">Contact Us</a></li>
			</ul>		
		</nav>

		
	<!--sidebar content-->		
		<aside role="complementary" class="three columns hide-on-phones">			

<?PHP include "includes-fe/aside-team.php"; ?>

<?PHP include "includes-fe/aside-events.php"; ?>

<?PHP include "includes-fe/aside-promo.php"; ?>

		</aside>

	</div><!--/mainbody-->
	
<?PHP include "includes-fe/footer.php"; ?>

</div><!--/container-->

<?PHP include "includes-fe/end.php"; ?>