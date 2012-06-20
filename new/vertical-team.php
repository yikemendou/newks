<?PHP require 'functions/vertical_team_inc.php'; ?>
<?PHP include "includes-fe/$beginphp"; ?>
 
<body>

<?PHP include "includes-fe/global-nav.php"; ?>

<!--headline-->
<div class="container banner short"><div class="row">
	<div class="three columns art-left hide-on-phones" style="background-image: url();">&nbsp;</div>
	<div class="seven columns pull-two">
		<ul class="breadcrumbs clearfix">
			<li><a href="home.php">Home</a></li>
			<li><a href="vertical.php">CIO Advisory</a></li>
		</ul>
		<h1>CIO Advisory Team</h1>
	</div>
</div></div><!--/headline-->

<!--main body of page-->
<div class="container">
	<div class="row">

		<article role="main" class="four columns push-three">

			<ol class="contents partners rightpop">
				<li class="active">
					<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
					<div class="item">
						<a href="#">Madison Riley</a>
						<span class="snippet">Title</span>
						<span class="detail">Area of focus</span>
						<span class="detail">City</span>
					</div><!--/item-->
				</li>
				<li>
					<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
					<div class="item">
						<a href="#">First Last</a>
						<span class="snippet">Title</span>
						<span class="detail">Area of focus</span>
						<span class="detail">City</span>
					</div><!--/item-->
				</li>
				<li>
					<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
					<div class="item">
						<a href="#">First Last</a>
						<span class="snippet">Title</span>
						<span class="detail">Area of focus</span>
						<span class="detail">City</span>
					</div><!--/item-->
				</li>
				<li>
					<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
					<div class="item">
						<a href="#">First Last</a>
						<span class="snippet">Title</span>
						<span class="detail">Area of focus</span>
						<span class="detail">City</span>
					</div><!--/item-->
				</li>
				<li>
					<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
					<div class="item">
						<a href="#">First Last</a>
						<span class="snippet">Title</span>
						<span class="detail">Area of focus</span>
						<span class="detail">City</span>
					</div><!--/item-->
				</li>
				<li>
					<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
					<div class="item">
						<a href="#">First Last</a>
						<span class="snippet">Title</span>
						<span class="detail">Area of focus</span>
						<span class="detail">City</span>
					</div><!--/item-->
				</li>
			</ol>
			
		</article>

	<!--local nav-->		
		<nav role="navigation" class="three columns pull-four">
			<ul class="category">
				<li><a href="vertical.php?vertical=<?php print $sector_id;?>">Overview</a></li>
				<li><a href="vertical-capabilities.php?vertical=<?php print $sector_id;?>">Capabilities</a></li>
				<li><a href="vertical-insights.php?vertical=<?php print $sector_id;?>">Latest Insights</a></li>
				<li class="active"><a href="vertical-team.php?vertical=<?php print $sector_id;?>">Team</a></li>
				<li class="show-on-phones"><a href="contact-service.php">Contact Us</a></li>
			</ul>		
		</nav>

		
	<!--sidebar content-->		
		<aside role="complementary" class="five columns hide-on-phones">
		
			<div class="bio">
				<h2>Madison Riley</h2>
				<h3>Title</h3>
				<p>Mr. Riley is the head of Kurt Salmon's North American Retail and Consumer Products Group. For more than 20 years, he has been providing retailers and consumer products companies with strategic planning, organizational design, consumer insights and merchandising process improvement services. Before joining Kurt Salmon, Mr. Riley was the president of Stride Rite, leading a chain of 300 specialty retail stores and a branded wholesale business. He is regularly cited in leading publications, including the <em>Wall Street Journal</em>.</p>
			</div>
						
		</aside>

	</div><!--/mainbody-->
	
<?PHP include "includes-fe/footer.php"; ?>

</div><!--/container-->

<?PHP include "includes-fe/end.php"; ?>