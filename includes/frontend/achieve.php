<?php
	global $qs_smoking;
	$smoke_stats = $qs_smoking->smoke_stats();

?>
<div class="achvmnt-wrapper <?php echo $qs_atts['class']; ?>">
	<div class="achvmnt-wrapper-inner">
		<h2 class="achvmnt-wrap-headig">Achievements</h2>
		<div class="achvmnt-content">

			<img src="<?php echo $smoke_stats['achievements']['time']['current']['image']; ?>" width="250">
		</div>
		<div class="achvmnt-foot">
			<a href="#explore-qs-achieve" class="money-explore-btn" rel="modal:open">View All</a>
			<!-- <a href="<?php echo home_url('/quit-smoking/achievements')?>" class="achvmnt-view-btn">View All</a> -->
		</div>
		<div class="modal" id="explore-qs-achieve">
			<div class="ac-modal-inner">
				<?php echo $this->qs_get_template('explore_achievement'); ?>
			</div>
      	</div>
	</div>
</div>