 			<div class="contents">
				<h4><a href="about-events.php?vertical=<?php print $sector_id?>">Related Events</a></h4>
				<ol>
					<?php foreach ($aside_events as $e){?>
					<li><a href="about-event-item.php?vertical=<?php print $sector_id?>&id=<?php print $e['id']?>"><?php print $e['event_name']?></a><span class="detail"><?php print $e['start_date']?>, <?php print $e['location_city']?></span></li>
 					<?php }?>
				</ol>
			</div><!--/contents-->