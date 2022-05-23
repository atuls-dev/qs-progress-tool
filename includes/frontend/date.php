<?php
	global $qs_smoking;
	$smoke_stats = $qs_smoking->smoke_stats();
	$get_smoke_data = $qs_smoking->qs_user_data();
	$qs_date_format  = $get_smoke_data['date_format'];
    $quit_date = date($qs_date_format,strtotime($get_smoke_data['quit_date']));
?>
<div class="quitdate-wrapper <?php echo $qs_atts['class']; ?>">
	<div class="quitdate-inner">
		<div class="quitdate-heading-wrap">
			<h2 class="quitdate-wrap-heading">Quit Date</h2>
			<!-- <div class="quitdate-edit-btn-wrap">
				<a href="#" rel="" class="quitdateedit-btn qs_date_popup">Edit</a>
			</div> -->
		</div>

		<div class="quitdate-wrap-content">
			<h1 class="quitdate-saved"><?php echo $quit_date; ?></h1>
		</div>

	</div>
</div>