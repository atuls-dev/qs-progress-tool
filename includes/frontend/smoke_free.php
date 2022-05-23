<?php
	global $qs_smoking;
	$smoke_stats = $qs_smoking->smoke_stats();

	if(!empty($smoke_stats)):
?>
<div class="skfr-wrapper <?php echo $qs_atts['class']; ?>">
	<div class="skfr-wrapper-inner">
		<?php if (!$smoke_stats['is_future_date']):?>
			<div class="skfredit-btn-wrap">
				<a href="#quit_date_form" rel="modal:open" class="skfredit-btn">Edit</a>
			</div>
		<?php endif; ?>
		<div class="skfr-wrap-status">
			<h3 class="smokefreefor"><?php echo ($smoke_stats['is_future_date'])?'Quitting Smoking In':'Smoke Free for'; ?> </h3>
			<div class="skfr-time">
				<?php
					$qs_future = ($smoke_stats['is_future_date'])?'future_':'past_';
					foreach ($smoke_stats['quit_time']['preview'] as $key => $value) {
						?>
							<div class="skfr-mins">
								<span class="days-number <?php echo $qs_future.strtolower($key);?>"><?php echo $value; ?></span>
								<span class="skfr-text"><?php echo ucfirst($key); ?><?php echo $qs_smoking->plural($value); ?></span>
							</div>
						<?php
					}
				?>
			</div>
		</div>
		<?php if (!$smoke_stats['is_future_date']):
		$next_remain = $smoke_stats['achievements']['time']['next']['num_type'];
		$current_remain = $smoke_stats['achievements']['time']['remaining']['TotalMinutes'];
		$rem_percent = (($next_remain-$current_remain)/$next_remain)*100;
		?>

			<!-- <div class="skfr-wrap-milestone">
				<h4 class="milestone-heading">Next Milestone:</h4>
				<h2 class="skfr-milestone"><?php echo $smoke_stats['achievements']['time']['next']['name']; ?></h2>
			</div>
 -->
						<div class="milestones">
						   <div class="next">
						      <h6>Next Milestone</h6>
						      <h2><?php echo $smoke_stats['achievements']['time']['next']['name']; ?></h2>
						   </div>
						   <div class="thirty-four">
						      <div class="qs_health_percent" data-percent="<?php echo $rem_percent; ?>">
						         <div class="qs_circle_inner">
						            <div class="qs_round_per"></div>
						         </div>
						      </div>
						      <div class="health-imp-titlebox">
						         <span class="health-imp-icon">
						         </span>
						      </div>
						   </div>
						   <div class="next">
						      <h6>Time remaining</h6>
						      <?php
						      $cont = 1;
								foreach ($smoke_stats['achievements']['time']['remaining']['preview'] as $key => $value) {
								?>
									<h2><?php echo $value; ?> <?php echo ucfirst($key); ?><?php echo $qs_smoking->plural($value); ?></h2>
									<?php
									if($cont == 1){
										break;
									}
									$cont++;
								}
							?>

						   </div>
						</div>


		<?php endif; ?>
		<div class="skfr-wrap-foot">
			<a href="#explore-qs-time" class="explore-btn" rel="modal:open"><?php echo ($smoke_stats['is_future_date'])?'View All':'Explore'; ?></a>
		</div>

		<div class="modal" id="explore-qs-time">
            <?php echo $this->qs_get_template('explore_time'); ?>
      	</div>

	</div>
</div>
<div class="modal" id="quit_date_form">
    <?php echo $this->qs_get_template('quit_date_form'); ?>
</div>
<?php endif; ?>