<?php
global $qs_smoking;
$get_smoke_data = $qs_smoking->qs_user_data();
$currency = $qs_smoking->qs_currency();
$qs_cig_price = '1';
$qs_cig_currency = file_get_contents('https://ipapi.co/'.$_SERVER["REMOTE_ADDR"].'/currency/');
$qs_currency_price = '$ 1';
if(!empty($get_smoke_data)){
  $qs_cig_price  = $get_smoke_data['cig_pack_price'];
  $qs_cig_currency = $get_smoke_data['currency'];
  $qs_currency_price = $currency[$qs_cig_currency]['symbol'].' '.$qs_cig_price;
}
?>
<form name="ciggeret_price_form" class="smoking_forms smkfr-wrapper-inner">
      <div class="smkfr-slide-form">
            <div class="smkfr-header">
                  <div class="smkfr-header-inr">
                    <span class="smkfr-header-icon">
                          <img src="<?php echo QSPROGRESS; ?>includes/assets/img/update-cigar.png">
                    </span>
                    <h2 class="slide-heading">Cost of Cigrattes</h2>
                  </div>
            </div>
            <div class="smkfr-body">
              <div class="cigar-cost">
                    <div class="cigar-cost-inr">
                          <span class="smkfr-label">Cost per pack</span>
                          <input name="cigarette_price" type="number" required id="qs_cig_price" class="qs_cig_price_fields" Placeholder="Cigarrete Price" value="<?php echo $qs_cig_price; ?>">
                    </div>
                    <input name="action" type="hidden" value="qs_add_diary">
                    <input name="form" type="hidden" value="cig_price_form">
                    <div class="cigar-cost-inr">
                          <span class="smkfr-label">Currency</span>
                          <select name="currency" class="qs_cig_price_fields" id="qs_cig_currency" required>
                          <?php foreach ($currency as $key=>$value) {
                                ?>
                          <option value='<?php echo $key; ?>' symbol='<?php echo  $value['symbol'] ; ?>' <?php echo ($qs_cig_currency == $key )?'selected':'' ?>><?php echo $value['name']." (".$value['symbol'].")" ; ?> </option><?php } ?></select>

                    </div>
              </div>
            </div>
      <div class="smkfr-foot">
            <input type="submit"  value="Save" class="submit-btn">
      </div>
    </div>
</form>