 
			<div class="contents">
				<h4><a href="vertical-team.php?vertical=<?php print $sector_id;?>">Meet the Team</a></h4>
				<ol>
				<?php foreach($sector_team as $t) {?>
					<li><a href="vertical-team.php?vertical=<?php print $sector_id;?>&id=<?php print $t['team_member_id'];?>"><?php print $t['first_name']?> <?php print $t['last_name']?></a><span class="detail"><?php print $t['title']; if($t['city']!=null){?>, <?php print $t['city'];}?></span></li>
				<?php }?>
				</ol>
			</div><!--/contents-->