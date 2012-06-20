<?PHP require 'functions/contact_inc.php'; ?>
<?PHP include "includes-fe/$beginphp"; ?>

<body>

<?PHP include "includes-fe/global-nav.php"; ?>

<!--headline-->
<div class="container banner short"><div class="row">
	<div class="three columns art-left hide-on-phones" style="background-image: url();">&nbsp;</div>
	<div class="nine columns withfilter">
		<ul class="breadcrumbs clearfix">
			<li><a href="#">Home</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
		<h1>General Inquiries</h1>

		<dl class="filter bottom">
			<dt class="hide">Filter:</dt>
			<dd><a href="#">Global</a></dd>
			<dd><a href="#">Media Inquiries</a></dd>
			<dd>|</dd>
			<dd><a href="#">Africa</a></dd>
			<dd><a href="#">Asia</a></dd>
			<dd><a href="#">Europe</a></dd>
			<dd class="active"><a href="#">North America</a></dd>
		</dl>
	</div>
</div></div><!--/headline-->

<!--main body of page-->
<div class="container">
	<div class="row">

		<article role="main" class="nine columns push-three nobottom">
		
			<section class="related">
				<h4>US</h4>
				<ol class="contents two-across">
					<li>
						<div class="item">
							<a href="#">San Francisco</a>
							<span class="detail">Street <br />City, State ZIP <br />+1 000-000-0000</span>
						</div><!--/item-->
					</li>
					<li>
						<div class="item">
							<a href="#">San Francisco</a>
							<span class="detail">Street <br />City, State ZIP <br />+1 000-000-0000</span>
						</div><!--/item-->
					</li>
					<li>
						<div class="item">
							<a href="#">San Francisco</a>
							<span class="detail">Street <br />City, State ZIP <br />+1 000-000-0000</span>
						</div><!--/item-->
					</li>
				</ol>
			</section>		

		</article>

	<!--local nav-->		
		<nav role="navigation" class="three columns pull-nine">
			<ul class="category">
				<li class="active"><a href="contact.php">General Inquiries</a></li>
				<li><a href="contact-service.php">Service Inquiries</a></li>
				<li><a href="contact-partner.php">Partner Lookup</a></li>
			</ul>		
		</nav>

		
	<!--sidebar content-->		
		<aside role="complementary" class="three columns hide-on-phones">			
		</aside>

	</div><!--/mainbody-->
	
<?PHP include "includes-fe/footer.php"; ?>

</div><!--/container-->

<?PHP include "includes-fe/end.php"; ?>