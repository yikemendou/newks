	<footer class="row">
		<div role="search" class="three columns push-nine">
			<form class="nice search">
				<input type="search" placeholder="Search" class="input-text" style="float: left; padding-right: 32px;" />
				<a href="#" title="Search"><img src="images/wayfinding_solid_chevron_right_21.png" alt="Search" width="21" height="21" /></a>
			</form>
		</div>

		<div role="contentinfo" class="seven columns pull-three">
			<ul class="legal">
				<li>&copy;&nbsp;Kurt Salmon</li>
				<li><a href="legal.php">Privacy policy</a></li>
				<li><a href="legal.php">Terms of use</a></li>
				<?php foreach ($languages as $l) {?>
				<li <?php if ($langauge_id==$l['language_id']){print "class=on";}?>>Change language <a href="<?php print $self_url;?>" class="language"><?php print $l['language_name'];?>&#9662;</a></li>
				<?php }?>
			</ul>		
		</div>
		<div class="two columns pull-three hide-on-phones">
			<ul class="social right">
				<?php if ($sns['show_twitter']){?><li><a href="<?php print $sns['twitter_url'];?>" title="Kurt Salmon on Twitter"><img src="images/social_twitter.png" alt="Kurt Salmon on Twitter" width="21" height="21" /></a></li><?php }?>
				<?php if ($sns['show_linkedin']){?><li><a href="<?php print $sns['linkedin_url'];?>" title="Kurt Salmon on LinkedIn"><img src="images/social_linkedin.png" alt="Kurt Salmon on LinkedIn" width="21" height="21" /></a></li><?php }?>
				<?php if ($sns['show_facebook']){?><li><a href="<?php print $sns['facebook_url'];?>" title="Kurt Salmon on Facebook"><img src="images/social_facebook.png" alt="Kurt Salmon on Facebook" width="21" height="21" /></a></li><?php }?>
				<?php if ($sns['show_rss']){?><li><a href="<?php print $sns['rss_url'];?>" title="Kurt Salmon RSS feed"><img src="images/social_rss.png" alt="Kurt Salmon on RSS feed" width="21" height="21" /></a></li><?php }?>
			</ul>
		</div>
	</footer>