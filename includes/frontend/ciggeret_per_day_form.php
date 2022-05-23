<?php
global $qs_smoking;
$get_smoke_data = $qs_smoking->qs_user_data();
$qs_cig_per_day = '0';
if(!empty($get_smoke_data)){
  $qs_cig_per_day = $get_smoke_data['cig_per_day'];
}
?>
<form name="ciggeret_per_day_form" class="smoking_forms smkfr-wrapper-inner">
  <div class="smkfr-slide-form"> <!-- Slider Starts -->
        <div class="smkfr-header">
              <div class="smkfr-header-inr">
               <span class="smkfr-header-icon">
                    <img src="<?php echo QSPROGRESS; ?>includes/assets/img/update-cigar.png">
              </span>
                    <h2 class="slide-heading">Number of cigrattes per day</h2>
              </div>
        </div>
        <div class="smkfr-body">
              <span class="smkfr-label">Cigarettes per day</span>
              <input name="cigarettes_per_day" class="qs_cig_per_day" type="number" required Placeholder="Cigarretes Per day" value="<?php echo $qs_cig_per_day ?>">
              <input name="action" type="hidden" value="qs_add_diary">
              <input name="form" type="hidden" value="cig_per_day_form">
        </div>
        <div class="smkfr-foot">
              <input type="submit" value="Save" class="submit-btn">
        </div>
  </div>
</form>