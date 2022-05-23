<?php
	global $qs_smoking;
	$smoke_stats = $qs_smoking->smoke_stats();

?>

<div class="mystats-wrap <?php echo $qs_atts['class']; ?>">
	<div class="mystats-wrap-iner">
		<h2 class="mystats-heading">My Stats</h2>
		<div class="mystats-grid">
			<div class="mystats-grid-items">
				<span class="mystats-count cig-count"><?php echo round($smoke_stats['cigarette_not_smoked']['cigarette']); ?></span>
				<h3 class="mystats-count-title">Cigarettes Not Smoked</h3>
			</div>
			<div class="mystats-grid-items">
				<span class="mystats-count money-count"><?php echo round($smoke_stats['money_saved']['money']); ?><small><?php echo $smoke_stats['money_saved']['currency']; ?></small></span>
				<h3 class="mystats-count-title">Money Saved</h3>
			</div>
			<div class="mystats-grid-items">
				<span class="mystats-count lyfreg-count"><?php echo round($smoke_stats['life_regained']); ?><small>Week<?php echo $qs_smoking->plural(round($smoke_stats['life_regained'])); ?></small></span>
				<h3 class="mystats-count-title">Expected Life Regained</h3>
			</div>

			<div class="mystats-grid-items">
				<?php if(!empty($smoke_stats)): ?>
				<span class="mystats-count time-count">
					<?php


						$qskey = array_keys($smoke_stats['not_smoked']['preview']);
						$qsvalue = array_values($smoke_stats['not_smoked']['preview']);


					?>

					<?php echo round($qsvalue[0]); ?><small><?php echo $qskey[0]; ?><?php echo $qs_smoking->plural(round($qsvalue[0])); ?></small></span>
				<?php endif; ?>
				<h3 class="mystats-count-title">Time Won Back</h3>
			</div>
		</div>
	</div>
</div>