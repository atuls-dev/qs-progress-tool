<?php
global $qs_smoking;
$quit_date = date('j F Y');
$date_format = $qs_smoking->qs_date_format();
$get_smoke_data = $qs_smoking->qs_user_data();
$qs_date_format  = "j F Y";
if(!empty($get_smoke_data)){
  $qs_date_format  = $get_smoke_data['date_format'];
  $quit_date = date($qs_date_format,strtotime($get_smoke_data['quit_date']));
  $quit_datemob = date('j M Y',strtotime($get_smoke_data['quit_date']));
}
?>
<form name="quit_date_form" class="smoking_forms smkfr-wrapper-inner">
  <div class="smkfr-slide-form"> <!-- Slider Starts -->
        <div class="smkfr-header">
              <div class="smkfr-header-inr">
               <span class="smkfr-header-icon">
                    <img src="<?php echo QSPROGRESS; ?>includes/assets/img/update-calender.png">
              </span>
                    <h2 class="slide-heading">Your Quit Date</h2>
              </div>
        </div>
        <div class="smkfr-body">
         <span class="smkfr-label">Date</span>
              <div class="smkfr-date-select">
                  <input id='smk_timeZone' name="timeZone" type="hidden" >
                    <!-- <select id="qs_day" class="qs_date_fields" name="quit_day" required></select>
                    <select id="qs_month" class="qs_date_fields" name="quit_month" required></select>
                    <select id="qs_year" class="qs_date_fields" name="quit_year" required></select> -->
                    <input name="quit_date" mbsc-input data-input-style="box" class="quit_date_input" type="text" value="<?php echo $quit_datemob; ?>" Placeholder="Date">
              </div>
              <div class="smkfr-tm">
                    <div class="smkfr-tm-inr">
                          <span class="smkfr-label">Time</span>
                          <input name="quit_time" mbsc-input data-input-style="box" class="quit_time_input" type="text" value="" Placeholder="Time">
                    </div>
                    <div class="smkfr-tm-inr">
                          <span class="smkfr-label">Format</span>
                          <select name="qs_date_format" class="qs_date_fields" id="qs_date_format" required>
                                <?php foreach ($date_format as $key=>$value) {
                                            $momentformat =  $qs_smoking->phpToMoment($key); ?>

                                            <option value="<?php echo $key; ?>" moment="<?php echo $momentformat?>" <?php echo ($qs_date_format == $key )?'selected':'' ?>><?php echo $value; ?></option>
                                     <?php }
                                ?>
                          </select>
                    </div>


              </div>
        </div>
        <div class="smkfr-foot">
              <input name="action" type="hidden" value="qs_add_diary">
              <input name="form" type="hidden" value="cig_quit_form">
              <input type="submit" value="Save Quit Date" class="submit-btn">
        </div>
  </div>
</form>