<?php
	global $qs_smoking;
	$smoke_stats = $qs_smoking->smoke_stats();
	$health_period = $qs_smoking->qs_health_card();
	$quit_hours = $smoke_stats['quit_time']['InHours']['hours'];
	 extract($health_period);




?>
<div class="health-imp-wrapper <?php echo $qs_atts['class']; ?>">
	<div class="health-imp-inner">
		<h2 class="mystats-heading health-imp">Health Improvement</h2>
		<div class="health-imp-grid">
			<div class="health-imp-item">
				<div class="qs_health_percent" data-percent="<?php echo $qs_smoking->extract_health_data($oxygen_level)->percent; ?>">
			    	<div class="qs_circle_inner">
			        	<div class="qs_round_per"></div>
			        </div>
			    </div>
				<div class="health-imp-titlebox">
					<span class="health-imp-icon">

					</span>
					<span class="health-imp-text oxygen">Oxygen Levels</span>
				</div>
			</div>
			<div class="health-imp-item">
				<div class="qs_health_percent" data-percent="<?php echo $qs_smoking->extract_health_data($imune_system)->percent; ?>">
			    	<div class="qs_circle_inner">
			        	<div class="qs_round_per"></div>
			        </div>
			    </div>
				<div class="health-imp-titlebox">
					<span class="health-imp-icon">

					</span>
					<span class="health-imp-text imunity">Imunity & Lung Function</span>
				</div>
			</div>
			<div class="health-imp-item">
				<div class="qs_health_percent" data-percent="<?php echo $qs_smoking->extract_health_data($decrease_heart_risk)->percent; ?>">
			    	<div class="qs_circle_inner">
			        	<div class="qs_round_per"></div>
			        </div>
			    </div>
				<div class="health-imp-titlebox">
					<span class="health-imp-icon">

					</span>
					<span class="health-imp-text risk">Reduced Risk of Heart Disease</span>
				</div>
			</div>
			<div class="health-imp-item">
				<div class="qs_health_percent" data-percent="<?php echo $qs_smoking->extract_health_data($pulse)->percent; ?>">
			    	<div class="qs_circle_inner">
			        	<div class="qs_round_per"></div>
			        </div>
			    </div>
				<div class="health-imp-titlebox">
					<span class="health-imp-icon">

					</span>
					<span class="health-imp-text pulse">Pulse Rate</span>
				</div>
			</div>
			<div class="health-imp-item">
				<div class="qs_health_percent" data-percent="<?php echo $qs_smoking->extract_health_data($oral_health)->percent; ?>">
			    	<div class="qs_circle_inner">
			        	<div class="qs_round_per"></div>
			        </div>
			    </div>
				<div class="health-imp-titlebox">
					<span class="health-imp-icon">

					</span>
					<span class="health-imp-text pulse">Oral health</span>
				</div>
			</div>
			<div class="health-imp-item">
				<div class="qs_health_percent" data-percent="<?php echo $qs_smoking->extract_health_data($lung_capacity)->percent; ?>">
			    	<div class="qs_circle_inner">
			        	<div class="qs_round_per"></div>
			        </div>
			    </div>
				<div class="health-imp-titlebox">
					<span class="health-imp-icon">

					</span>
					<span class="health-imp-text imunity">Increased Lung Capacity</span>
				</div>
			</div>

		</div>
	    <div class="money-wrap-foot">
				<a href="#view-health" rel="modal:open" class="money-explore-btn">View All</a>
			</div>
	</div>
</div>

 <div class="modal" id="view-health">
	<?php echo $this->qs_get_template('all_health'); ?>
</div>