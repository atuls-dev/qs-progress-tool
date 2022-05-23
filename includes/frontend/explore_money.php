<?php
	global $qs_smoking;
	$smoke_stats = $qs_smoking->smoke_stats();
	$perdaysaving = $smoke_stats['money_saved']['per_day'];
	$currency = $smoke_stats['money_saved']['currency_symbol'];
?>
<div class="saved-money-wrapper">
	<div class="saved-money-inner">
		<h3>Future projections:</h3>
		<div class="saved-money-list">
			<span class="saved-money-item"><?php echo $perdaysaving*90 .' '.$currency; ?> Money Saved in 3 Months</span>
			<span class="saved-money-item"><?php echo $perdaysaving*180 .' '.$currency; ?> Money Saved in 6 Months</span>
			<span class="saved-money-item"><?php echo $perdaysaving*365 .' '.$currency; ?> Money Saved in 1 Year</span>
			<span class="saved-money-item"><?php echo $perdaysaving*548 .' '.$currency; ?> Money Saved in 1.5 Year</span>
			<span class="saved-money-item"><?php echo $perdaysaving*730 .' '.$currency; ?> Money Saved in 2 Years</span>
			<span class="saved-money-item"><?php echo $perdaysaving*1825 .' '.$currency; ?> Money Saved in 5 Years</span>
			<span class="saved-money-item"><?php echo $perdaysaving*3650 .' '.$currency; ?> Money Saved in 10 Years</span>
			<span class="saved-money-item"><?php echo $perdaysaving*5475 .' '.$currency; ?> Money Saved in 15 Years</span>
			<span class="saved-money-item"><?php echo $perdaysaving*7300 .' '.$currency; ?> Money Saved in 20 Years</span>
		</div>
	</div>
</div>