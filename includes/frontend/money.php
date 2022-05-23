<?php
	global $qs_smoking;
	$qs_cig_price = '';
	$smoke_stats = $qs_smoking->smoke_stats();
	$get_smoke_data = $qs_smoking->qs_user_data();
	if(!empty($get_smoke_data)){

	     $qs_cig_price  = (int)$get_smoke_data['cig_pack_price'];

	}
?>
<div class="money-wrapper <?php echo $qs_atts['class']; ?>">
	<div class="money-wrap-inner">
		<div class="money-heading-wrap">
			<h2 class="money-wrap-heading">Money Saved</h2>

		</div>
		<?php if(!empty($qs_cig_price)){ ?>
		<div class="money-wrap-content">
			<h1 class="money-saved"><?php echo $smoke_stats['money_saved']['currency_symbol'].$smoke_stats['money_saved']['money']; ?></h1>
			<h3 class="money-saved-title"></h3>
		</div>
		<div class="money-wrap-foot">
			<a href="#explore-qs-money" rel="modal:open" class="money-explore-btn">Explore</a>
		</div>
		<?php }else{ ?>
		<div class="money-wrap-foot">
			<a href="#ciggeret_price_form" rel="modal:open" class="money-explore-btn">Add Money Details</a>
		</div>
		<?php } ?>
	</div>
</div>
<div class="modal" id="ciggeret_price_form">
    <?php echo $this->qs_get_template('ciggeret_price'); ?>
</div>
<div class="modal" id="explore-qs-money">
	<?php echo $this->qs_get_template('explore_money'); ?>
</div>