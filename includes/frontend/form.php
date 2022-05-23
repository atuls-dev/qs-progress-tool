<?php
$user_id = '';
$quit_date = '';
$qs_cig_per_day = '';
$qs_cig_price = '';
$qs_cig_currency = '';
$qs_currency_price = '';
$qs_date_format  = "";


$currency = $this->qs_currency();
$date_format = $this->qs_date_format();
$get_smoke_data = $this->qs_user_data();
if(!empty($get_smoke_data)){
     $user_id = $get_smoke_data['user_id'];
     $qs_date_format  = $get_smoke_data['date_format'];
     $quit_date = date($qs_date_format,strtotime($get_smoke_data['quit_date']));
     $qs_cig_per_day = $get_smoke_data['cig_per_day'];
     $qs_cig_price  = $get_smoke_data['cig_pack_price'];
     $qs_cig_currency = $get_smoke_data['currency'];
     $qs_currency_price = $currency[$qs_cig_currency]['symbol'].' '.$qs_cig_price;
}




?>

<div class="smkfr-wrapper <?php echo $param['class']; ?>">
      <div class="smkfr-wrapper-inner">
            <div class="smoke_free_form">
                  <?php if(empty($get_smoke_data)): ?>
                  <div class="smkfr-slide qs_slide_1 qs_visible">
                        <div class="smkfr-header">
                              <div class="smkfr-header-inr">
                                    <h2 class="slide-heading">Add your quit date to start tracking your progress</h2>
                              </div>
                        </div>
                        <div class="smkfr-body">
                              <div class="stdt-wrap">
                                    <div class="stdt-wrap-inner">
                                          <img src="<?php echo QSPROGRESS; ?>includes/assets/img/calender-icon.png">
                                    </div>
                                    <div class="stdt-wrap-inner">
                                          <a href="javascript:void(0);" class="addt-btn qs_slide_btn" current="1">Add Your Quit Smoking Date</a>
                                          <small>Your quit date can be in a date in the past or in the future.</small>
                                    </div>
                              </div>
                        </div>
                  </div> <!-- Slider Ends -->
                  <?php endif; ?>

                  <div class="smkfr-slide qs_slide_2 <?php echo (!empty($get_smoke_data))?'qs_visible':''; ?>"> <!-- Slider Starts -->
                        <div class="smkfr-header">
                              <div class="smkfr-header-inr">
                                    <h2 class="slide-heading">Your Quit Smoking Details</h2>
                              </div>
                        </div>
                        <div class="smkfr-body">
                              <div class="qtskg-dt-wrap">
                                    <ul class="qtskg-dt-list">
                                          <li class="qtskg-dt-item quit_date_form">
                                                <div class="qs_with_data <?php echo empty($quit_date)?'qs_hide':''; ?>">
                                                      <div class="qtskg-dt dt-left">
                                                            <span class="qtskg-dt-icon">
                                                                  <img src="<?php echo QSPROGRESS; ?>includes/assets/img/calender.png">
                                                            </span>
                                                            <span class="qtskg-dt-text">
                                                                  <h5>Your Quit Date</h5>
                                                                  <h2 class="qs_date_text"><?php echo $quit_date ?></h2>
                                                            </span>
                                                      </div>
                                                      <div class="qtskg-dt dt-right">
                                                            <span class="dt-right-icon">
                                                                  <img src="<?php echo QSPROGRESS; ?>includes/assets/img/pencil.png">
                                                            </span>
                                                            <a href="#quit_date_form" rel="modal:open" class="edit_link">Edit</a>
                                                      </div>
                                                </div>
                                                <div class="qs_no_data <?php echo !empty($quit_date)?'qs_hide':''; ?>">
                                                      <div class="stdt-wrap">
                                                            <div class="stdt-wrap-inner">
                                                                  <img src="<?php echo QSPROGRESS; ?>includes/assets/img/calender.png">
                                                            </div>
                                                            <div class="stdt-wrap-inner">
                                                                  <h5>Your Quit Date</h5>
                                                                  <a href="#quit_date_form" rel="modal:open" class="addt-btn qs_slide_btn" current="1">Add Your Quit Smoking Date</a>
                                                            </div>
                                                      </div>
                                                </div>

                                          </li>

                                          <li class="qtskg-dt-item ciggeret_per_day_form">
                                                <div class="qs_with_data <?php echo empty($qs_cig_per_day)?'qs_hide':''; ?>">
                                                      <div class="qtskg-dt dt-left">
                                                            <span class="qtskg-dt-icon">
                                                                  <img src="<?php echo QSPROGRESS; ?>includes/assets/img/cigar.png">
                                                            </span>
                                                            <span class="qtskg-dt-text">
                                                                  <h5>Cigarettes Per Day (On Average)</h5>
                                                                  <h2 class="qs_cig_per_day_text"><?php echo $qs_cig_per_day ?></h2>
                                                            </span>
                                                      </div>
                                                      <div class="qtskg-dt dt-right">
                                                            <span class="dt-right-icon">
                                                                  <img src="<?php echo QSPROGRESS; ?>includes/assets/img/pencil.png">
                                                            </span>
                                                            <a href="#ciggeret_per_day_form" rel="modal:open" class="edit_link">Edit</a>
                                                      </div>
                                                </div>
                                                <div class="qs_no_data <?php echo !empty($qs_cig_per_day)?'qs_hide':''; ?>">
                                                      <div class="stdt-wrap">
                                                            <div class="stdt-wrap-inner">
                                                                  <img src="<?php echo QSPROGRESS; ?>includes/assets/img/cigar.png">
                                                            </div>
                                                            <div class="stdt-wrap-inner">
                                                                  <h5>How many cigarettes you smoke per day? (On average)</h5>
                                                                  <a href="#ciggeret_per_day_form" rel="modal:open" class="addt-btn qs_slide_btn" current="1">Add number of cigarettes</a>
                                                            </div>
                                                      </div>
                                                </div>
                                          </li>

                                          <li class="qtskg-dt-item ciggeret_price_form">
                                                <div class="qs_with_data <?php echo empty($qs_cig_price)?'qs_hide':''; ?>">
                                                      <div class="qtskg-dt dt-left">
                                                            <span class="qtskg-dt-icon">
                                                                  <img src="<?php echo QSPROGRESS; ?>includes/assets/img/cash-n-coin.png">
                                                            </span>
                                                            <span class="qtskg-dt-text">
                                                                  <h5>Cost per pack of 20</h5>
                                                                  <h2 class="qs_cig_price_text"><?php echo $qs_currency_price; ?></h2>
                                                            </span>
                                                      </div>
                                                      <div class="qtskg-dt dt-right">
                                                            <span class="dt-right-icon">
                                                                  <img src="<?php echo QSPROGRESS; ?>includes/assets/img/pencil.png">
                                                            </span>
                                                            <a href="#ciggeret_price_form" rel="modal:open" class="edit_link">Edit</a>
                                                      </div>
                                                </div>
                                                <div class="qs_no_data <?php echo !empty($qs_cig_price)?'qs_hide':''; ?>">
                                                      <div class="stdt-wrap">
                                                            <div class="stdt-wrap-inner">
                                                                  <img src="<?php echo QSPROGRESS; ?>includes/assets/img/cash-n-coin.png">
                                                            </div>
                                                            <div class="stdt-wrap-inner">
                                                                  <h5>Cost per pack of 20</h5>
                                                                  <a href="#ciggeret_price_form" rel="modal:open" class="addt-btn qs_slide_btn" current="1">Add cost per pack</a>
                                                            </div>
                                                      </div>
                                                </div>
                                          </li>
                                    </ul>
                              </div>
                        </div>

                  </div> <!-- Slider Ends -->
                  <div class="modal" id="quit_date_form">
                        <?php echo $this->qs_get_template('quit_date_form'); ?>
                  </div>

                   <div class="modal" id="ciggeret_per_day_form">
                        <?php echo $this->qs_get_template('ciggeret_per_day_form'); ?>
                  </div>

                   <div class="modal" id="ciggeret_price_form">
                        <?php echo $this->qs_get_template('ciggeret_price'); ?>
                  </div>

                  </div> <!-- Slider Ends -->


      </div>
</div>
