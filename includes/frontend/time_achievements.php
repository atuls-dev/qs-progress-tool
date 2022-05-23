<?php
	global $qs_smoking;
	$smoke_stats 	= $qs_smoking->smoke_stats();
	$achievements 	= $qs_smoking->get_all_achievements('time');
?>
<div class="time-achived-wrapper <?php echo $qs_atts['class']; ?>">
	<div class="time-achived-inner">
		<h2 class="achvmnt-wrap-headig achived-time-heading">Time achievement</h2>
		<div class="time-achived-content">
			<ul class="achived-time-list">
				<?php
					foreach ($achievements as $key => $achievement) {
						$myachievement = $smoke_stats['achievements']['time']['current']['num_type'];
						$achieved = ($achievement['num_type'] <= $myachievement)?'achived':'';
						echo '<li class="achived-time-item '.$achieved.'" achieved="'.$achievement['num_type'].'">';
							echo "<img src='".$achievement['image']."'>";
						echo '</li>';
					}
				?>
			</ul>
		</div>
	</div>
</div>