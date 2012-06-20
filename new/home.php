<?PHP require 'functions/home_inc.php'; ?>
<?PHP include "includes-fe/$beginphp"; ?>
<body>

<?PHP include "includes-fe/global-nav.php"; ?>

<!--headline-->
	<div class="container intro">
		<div class="row">
			<div class="six columns">
				<h1><?php print $home['home_title']?></h1>
			</div>
			<div class="five columns">
				<h2><?php print $home['home_slug']?> <a href="#">More about Kurt
						Salmon</a>
				</h2>
			</div>
			<div class="one column hide-on-phones">&nbsp;</div>
		</div>
	</div>
	<!--/headline-->

	<!--highlights-->
	<div class="container banner tall hide-on-phones">
		<div class="row">
			<h4 class="pad-bottom">
				<a href="#">Latest Insights</a>
			</h4>
			<ol class="contents thumbs six-across">
	    <?php foreach ($home_insights as $insight) {?>
	    
	    		<li><a href="vertical-insight.php?id=<?php print $insight['publication_id']?>"><img
						src="<?php	
                        if ($insight ['file_name'] != null) {
							print "user_images/".$insight ['file_name'];
						} else {
							print "images/spot_insight_cloud.png";
						}
						?>"
						alt="<?php	
                        if ($insight ['file_name'] != null) {
							print $insight ['file_name'];
						} else {
							print "spot_insight_cloud";
						}
						?>" /></a>

					<div class="item">
						<a
							href="vertical-insight.php?id=<?php print $insight['publication_id']?>">
						<?php print $insight['publication_name'];?></a>
					</div> <!--/item--></li>
		
	    <?php }?>
			</ol>
		</div>
	</div>
	<!--/highlights-->

	<!--main body of page-->
	<div class="container">
		<div class="row">
			<div class="four columns">
				<h4>Our services</h4>
				<ol class="contents arrows super">
			<?php foreach ($home_our_services as $s){?>
				<li><a href="vertical.php?vertical=<?php print $s['id']?>"><?PHP print $s['name'] ;?></a></li>	
 			<?php }?>		
			</ol>
			</div>

			<div class="four columns hide-on-phones">
				<h4>
					<a href="about-news.php">News</a>
				</h4>
				<ol class="contents">
				<?php foreach ($home_news as $n){?>
				             
							<li><a href="<?php if ($n['news_url']==null){?>about-news-item.php?id=<?php print $n['id'];?><?php } else {
						print $n['news_url']; }?>"><?php print $n['headline'];?></a>
							<span class="detail"><?php print $n['news_date'];?></span></li>							
				<?php }?>
				</ol>
			</div>

			<div class="four columns hide-on-phones">
				<h4>
					<a href="about-events.php">Events</a>
				</h4>
				<ol class="contents">
				<?php foreach($home_events as $e) {?>
							<li><a href="<?php if ($n['news_url']==null){?>about-events-item.php?id=<?php print $e['id'];?><?php } else {
						print $e['event_url']; }?>"><?php 
							print $e['event_name'];?></a><span class="detail"><?php print $e['location_city'];?>, 
							<?php print $e['start_date']?></span></li>
				<?php }?>
				</ol>
			</div>
		</div>
		<!--/mainbody-->
	
<?PHP include "includes-fe/footer.php"; ?>

</div>
	<!--/container-->

<?PHP include "includes-fe/end.php"; ?>