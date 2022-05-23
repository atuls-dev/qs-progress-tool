<?php
	global $qs_smoking;
	$smoke_stats = $qs_smoking->smoke_stats();

?>
<div class="smkfree-pro-wrapper">
	<div class="smkfree-pro-inner">
		<h3>My Progress</h3>
		<h4 class="blue-heading"><?php echo ($smoke_stats['is_future_date'])?'Quitting Smoking In':'Smoke For free'; ?></h4>
		<ul class="smkfree-pro-list">
			<?php 	foreach ($smoke_stats['quit_time']['InYear'] as $key => $explore):
						echo '<li class="smkfree-pro-item">'.$explore.' '.ucfirst($key).''.$qs_smoking->plural($explore).'</li>';
					endforeach;
			?>
		</ul>
		<?php if (!$smoke_stats['is_future_date']):?>
		<h4 class="blue-heading">Next Milestone in</h4>
		<div class="smkfree-nextmilestone">
			<?php
			foreach ($smoke_stats['achievements']['time']['remaining']['preview'] as $key => $value) {
					?>
						<div class="smkfree-nextmilestone-time">
							<span class="smkfree-pro-time "><?php echo $value; ?></span>
							<span class="smkfree-pro-text"><?php echo ucfirst($key); ?><?php echo $qs_smoking->plural($value); ?></span>
						</div>
					<?php
				}
				?>

		</div>
		<?php endif; ?>
	</div>
</div>