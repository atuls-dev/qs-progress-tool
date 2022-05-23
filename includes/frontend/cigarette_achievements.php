<?php
	global $qs_smoking;
	$smoke_stats 	= $qs_smoking->smoke_stats();
	$achievements 	= $qs_smoking->get_all_achievements('cigarette');
?>
<div class="money-achived-wrapper <?php echo $qs_atts['class']; ?>">
	<div class="money-achived-inner">
		<h2 class="achvmnt-wrap-headig achived-money-heading">Cigarette achievement</h2>
		<div class="money-achived-content">
			<ul class="achived-money-list">
				<?php
					foreach ($achievements as $key => $achievement) {
						$myachievement = $smoke_stats['cigarette_not_smoked']['cigarette'];
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