<?php require_once 'functions/setup.php';?>
<!--global nav-->
<header>
	<div class="row masthead hide-on-phones">
		<a href="index.html" title="Kurt Salmon"><img src="images/logo.png"
			alt="Kurt Salmon" width="165" height="37" /></a>
	</div>
	<div class="row masthead show-on-phones">
		<a href="index.html" title="Kurt Salmon"><img class="left"
			src="images/logo.svg" alt="Kurt Salmon" width="145" height="32" /></a><a
			href="index.html" title="Kurt Salmon"><img class="right"
			src="images/mobile-menu.svg" alt="menu" width="32" height="32" /></a>
	</div>
	<nav class="nav-bar-wrapper full hide-on-phones" role="navigation">
		<div class="row">
			<ul class="nav-bar">
				<li><a href="home.php" class="main"><?php translate("Home")?></a></li>
				<li class="has-flyout"><a href="#" class="main" <?php if($nav1 == "services"){?> class="on"<?php }?>><?php translate("Services")?></a> <a
					href="#" class="flyout-toggle"><span></span></a>
					<div class="flyout">
						<ul>
							<?php foreach ($sector as $s){?>
							<li><a href="vertical.php?vertical=<?php print $s['id'];?>"><?PHP print $s['name'] ;?></a></li>
							<?php }?>
						</ul>
					</div></li>
				<li><a href="insights.php" class="main"<?php if($nav1 == "insights"){?> class="on"<?php }?> ><?php translate("Insights")?></a></li>
				<li><a href="about.php" class="main" <?php if($nav1 == "about"){?> class="on"<?php }?>><?php translate("About")?></a></li>
				<li><a href="http://us.careers.kurtsalmon.com/" class="main"
					target="_blank"><?php translate("Careers")?></a></li>
				<li><a href="contact.php" class="main" <?php if($nav1 == "contact"){?> class="on"<?php }?>><?php translate("Contact")?></a></li>
				<li class="right has-flyout"><a href="#" class="main"><?php print $country_name;?></a> <a
					href="#" class="flyout-toggle"><span></span></a>
					<div class="flyout small right">
						<ul>
						<?php foreach ($countries as $c){?>
						<li value="<?php print $c['domain_id'];?>" <?php if($domain_id == $c['domain_id']){?> class="on" <?php }?>><a href="<?php print "kurtsalmon.".$c['tld'];?>"><?php print $c['name'];?></a></li>
						<?php }?>
						 
						</ul>
					</div></li>
			</ul>
		</div>
	</nav>
</header>