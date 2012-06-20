<?PHP $page_title="Service Inquiries" ?>

<?PHP include "includes-fe/begin.php"; ?>

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
		<h1>Service Inquiries</h1>

		<dl class="filter bottom">
			<dt class="hide">Filter:</dt>
			<dd class="active"><a href="#">All Services &#9662;</a></dd>
			<dd class="active"><a href="#">US &#9662;</a></dd>
		</dl>
	</div>
</div></div><!--/headline-->

<!--main body of page-->
<div class="container">
	<div class="row">

		<article role="main" class="nine columns push-three nobottom">
		
			<section class="related">
				<h4>Get In Touch</h4>
				
				<form class="nice">
					<label for="standardNiceInput">Name</label>
						<input type="text" class="input-text large" id="standardNiceInput" />
					<label for="standardNiceInput">Organization</label>
						<input type="text" class="input-text large" id="standardNiceInput" />
					<label for="standardNiceInput">Email</label>
						<input type="text" class="input-text large" id="standardNiceInput" />
					<label for="niceTextarea">Message</label>
						<textarea id="niceTextarea" rows="4" class="large"></textarea>
	
					<div class="buttonstrip">
						<a href="#" class="small round white button">Cancel</a>
						<a href="#" class="small round blue button">Send</a>
					</div>
				</form>
			</section>
		
			<section class="related">
				<h4>US</h4>
				<ol class="contents partners three-across">
					<li>
						<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
						<div class="item">
							<a href="#">First Last</a>
							<span class="snippet">Title</span>
							<span class="detail">Area of focus</span>
						</div><!--/item-->
					</li>
					<li>
						<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
						<div class="item">
							<a href="#">First Last</a>
							<span class="snippet">Title</span>
							<span class="detail">Area of focus</span>
						</div><!--/item-->
					</li>
					<li>
						<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
						<div class="item">
							<a href="#">First Last</a>
							<span class="snippet">Title</span>
							<span class="detail">Area of focus</span>
						</div><!--/item-->
					</li>
					<li>
						<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
						<div class="item">
							<a href="#">First Last</a>
							<span class="snippet">Title</span>
							<span class="detail">Area of focus</span>
						</div><!--/item-->
					</li>
					<li>
						<a href="#"><img src="images/portrait_karonis.png" alt="portrait_karonis" /></a>
						<div class="item">
							<a href="#">First Last</a>
							<span class="snippet">Title</span>
							<span class="detail">Area of focus</span>
						</div><!--/item-->
					</li>
				</ol>
			</section>		
		</article>

	<!--local nav-->		
		<nav role="navigation" class="three columns pull-nine">
			<ul class="category">
				<li><a href="contact.php">General Inquiries</a></li>
				<li class="active"><a href="contact-service.php">Service Inquiries</a></li>
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