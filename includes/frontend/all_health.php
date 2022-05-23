<?php
  global $qs_smoking;
  $smoke_stats = $qs_smoking->smoke_stats();
  $health_period = $qs_smoking->qs_health_card();
  $quit_hours = $smoke_stats['quit_time']['InHours']['hours'];
  extract($health_period);





?>

<div class="health-cards-wrapper">
   <div class="health-cards-inner">
      <!-- Card start -->

       <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($blood_pressure)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Blood Pressure (will be 100% in <?= $blood_pressure; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($blood_pressure)->percent < 100){
               ?>
                  <p>In  <?= $qs_smoking->extract_health_data($blood_pressure)->remain; ?>, your blood pressure, heart rate, and body temperature will return to normal. Also, your blood circulation will start improving.</p>
               <?php
               }else{ ?>
               <p>Your blood pressure, heart rate, and the temperature of your body have returned to normal. Your blood circulation starts to improve.</p>
             <?php } ?>
         </div>
      </div>



    <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($nicotine_level)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Reduced Nicotine Levels (Will reach 100% in <?= $nicotine_level; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($nicotine_level)->percent < 100){
               ?>
            <p>In <?= $qs_smoking->extract_health_data($nicotine_level)->remain; ?>, your body will have expelled more than half of the nicotine that was in your system.</p>
             <?php
               }else{ ?>
            <p>Your body has expelled more than half of the nicotine that was in your system.</p>
            <?php } ?>
         </div>
      </div>


       <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($oxygen_level)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Oxygen Levels (<?= $oxygen_level; ?>)</h3>
             <?php if($qs_smoking->extract_health_data($oxygen_level)->percent < 100){ ?>
             <p>In <?= $qs_smoking->extract_health_data($oxygen_level)->remain; ?>, your body will have expelled the carbon monoxide that was in your tobacco, and your body’s oxygen levels will return to normal.</p>
             <?php }else{ ?>
             <p>Your body has expelled the carbon monoxide that was in your tobacco, and your body’s oxygen levels have returned to normal</p>
             <?php } ?>
         </div>
      </div>


  <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($heart_risk)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Reduced Risk of Heart Disease (<?= $heart_risk; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($heart_risk)->percent < 100){ ?>
            <p>As your blood pressure and circulation improve, in <?= $qs_smoking->extract_health_data($heart_risk)->remain; ?>, you will have reduced your risk of heart disease from high blood pressure caused by smoking.</p>
            <?php }else{ ?>
            <p>Your blood pressure and circulation keep improving, and you’ve already reduced your risk of heart disease from high blood pressure caused by smoking.</p>
            <?php } ?>
         </div>
      </div>


           <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($taste_smell)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Taste & Smell (<?= $taste_smell; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($taste_smell)->percent < 100){ ?>
            <p>Smoking harms your taste buds and reduces your sense of smell by damaging the olfactory nerves located in the back of your nose. In <?= $qs_smoking->extract_health_data($taste_smell)->remain; ?>,
your nerve endings will start to regrow, and your senses of taste and smell will begin to improve.</p>
<?php }else{ ?>
            <p>Smoking harms your taste buds and reduces your sense of smell by damaging the olfactory nerves located in the back of your nose. By now,
nerve endings start to regrow, and your senses of taste and smell have begun to improve.</p>
<?php } ?>
         </div>
      </div>



           <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($body_nicotine)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Nicotine Leaves Your Body (<?= $body_nicotine; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($body_nicotine)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($body_nicotine)->remain; ?>, almost all nicotine will be out of your body, and you’ll be getting rid of the physical addiction to nicotine.</p>
            <?php }else{ ?>
            <p>Almost all nicotine is out of your body! Moving forward, you may experience a few hunger-like cravings, but each craving won’t last more than 3minutes.</p>
            <?php } ?>
         </div>
      </div>


      <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($nicotine_free)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>You’re Officially Nicotine Free! (<?= $nicotine_free; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($nicotine_free)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($nicotine_free)->remain; ?>, you’ll be nicotine free!</p>
            <?php }else{ ?>
            <p>Congratulations! You have conquered the physical addiction to nicotine. Cravings may peak today but will subside tomorrow. After tomorrow, any cravings you may experience are mental.</p>
            <?php } ?>
         </div>
      </div>


        <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($blood_sugar)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Normal Blood Sugar Levels (<?= $blood_sugar; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($blood_sugar)->percent < 100){ ?>
            <p>Nicotine inhibits the release of insulin from the pancreas, which makes you have more sugar in your blood. When you first quit, you have low
blood sugar levels that cause irritation, tiredness, anxiety, dizziness, and restlessness - the most common withdrawal symptoms. In <?= $qs_smoking->extract_health_data($blood_sugar)->remain; ?>, your
blood sugar levels will return to normal, and those side-effects will decrease.</p>
<?php }else{ ?>
            <p>Your blood sugar levels have returned to normal, and withdrawal symptoms like dizziness, tiredness, confusion, and brain fog have decreased.</p>
            <?php } ?>
         </div>
      </div>


        <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($sex_drive)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Sex Drive (<?= $sex_drive; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($sex_drive)->percent < 100){ ?>
          <p>In <?= $qs_smoking->extract_health_data($sex_drive)->remain; ?>, the improvement of your blood flow will result in easier arousal and orgasms and a healthier sex life (for both men and women).</p>
          <?php }else{ ?>
            <p>Your sex drive has improved due to increased blood flow.</p>
            <?php } ?>
         </div>
      </div>


       <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($oral_health)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Oral health (<?= $oral_health; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($oral_health)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($oral_health)->remain; ?>, the blood circulation in your gums and teeth will be similar to that of a non-smoker.</p>
            <?php }else{ ?>
            <p>The blood circulation in your gums and teeth is now similar to that of a non-smoker.</p>
            <?php } ?>
         </div>
      </div>


         <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($brain_balance)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Brain Balance (<?= $brain_balance; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($brain_balance)->percent < 100){ ?>
            <p>When you smoke, nicotine goes to your brain and binds to the nicotinic acetylcholine receptors, triggering dopamine release. The number of
nicotine receptors increases the more you smoke, making you want to smoke even more to feel normal. When you quit, the additional nicotine
receptors created by years of smoking start to perish and in <?= $qs_smoking->extract_health_data($brain_balance)->remain; ?> will return to the levels seen in non-smokers.</p>
<?php }else{ ?>
            <p>Your brain is healthier, and your desire and need to smoke have decreased as your nicotine receptors have returned to the levels seen in nonsmokers.</p>
            <?php } ?>
         </div>
      </div>


         <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($increased_energy)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Increased Energy (<?= $increased_energy; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($increased_energy)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($increased_energy)->remain; ?>, you will have more energy to work, walk, and socialize.</p>
            <?php }else{ ?>
            <p>Your energy levels have improved as your body starts regaining its health, so you will have more energy to work, walk, and socialize.</p>
         <?php } ?>
         </div>
      </div>



   <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($imune_system)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Stronger Immune System (<?= $imune_system; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($imune_system)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($imune_system)->remain; ?>, your immune system will have significantly improved, helping you fight colds, flu, and viruses.</p>
            <?php }else{ ?>
            <p>From the second week of your smoke-free life until this point, your immune system continues to improve, helping you fight colds, flu, and viruses.</p>
            <?php } ?>
         </div>
      </div>


      <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($lung_capacity)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Increased Lung Capacity (<?= $lung_capacity; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($lung_capacity)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($lung_capacity)->remain; ?>, your lung capacity will increase by 10%-30%, and your chronic cough, wheezing, and short breath will start to disappear.</p>
            <?php }else{ ?>
            <p>Your chronic cough, wheezing, and short breath have started to disappear as your lung capacity has increased by 10%-30%. That increase can
be the difference between feeling great while taking a walk and coughing when climbing up the stairs. The cilia in your lungs have regrown and
clear out toxins and mucus from your lungs. This detox can cause phlegm, chest tightness, and cough.</p>
<?php } ?>
         </div>
      </div>


  <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($mental_health)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Mental Health (<?= $mental_health; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($mental_health)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($mental_health)->remain; ?>, the dopamine levels in your brain will return to normal, and you will feel mentally healthier and happier.</p>
            <?php }else{ ?>
            <p>The dopamine levels in your brain have returned to normal. This is a remarkable milestone. For years, nicotine has been triggering dopamine
release, causing imbalances in your dopamine reserves and making you feel you need nicotine to cope and enjoy life. Now your brain can
produce dopamine naturally and without expecting nicotine anymore.</p>
<?php } ?>
         </div>
      </div>


    <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($fertility)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Fertility (<?= $fertility; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($fertility)->percent < 100){ ?>
            <p>Smoking negatively impacts men’s fertility and women’s ability to conceive, even in light smokers. In <?= $qs_smoking->extract_health_data($fertility)->remain; ?>, your fertility will improve. If you’re a woman, you will have more chances of conceiving (and your chances will improve even more within the first year of being smoke-free). If you’re a man, you will have much healthier sperm that can fertilize an egg and create a healthy baby.</p>
            <?php }else{ ?>
            <p>Your fertility has improved. If you’re a woman, you now have more chances of conceiving (and your chances will improve even more within the
first year of being smoke-free). If you’re a man, you have much healthier sperm that can fertilize an egg and create a healthy baby.</p>
<?php } ?>
         </div>
      </div>



  <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($decrease_heart_risk)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Decreased Risk of Heart Attack (<?= $decrease_heart_risk; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($decrease_heart_risk)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($decrease_heart_risk)->remain; ?>, your risk of heart attack and coronary disease will be half than that of a smoker.</p>
            <?php }else{ ?>
            <p>Your heart is healthier than ever. Your risk of heart attack and coronary disease is half than that of a smoker.</p>
            <?php } ?>
         </div>
      </div>


  <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($cancer_risk)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Decreased Risk of Cancer (<?= $cancer_risk; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($cancer_risk)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($cancer_risk)->remain; ?>, your risk of developing cancer of the mouth, throat, esophagus, and bladder will drop by half.</p>
            <?php }else{ ?>
            <p>Your risk of developing cancer of the mouth, throat, esophagus, and bladder has dropped by half.</p>
            <?php } ?>
         </div>
      </div>


  <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($stroke_risk)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Reduced Risk of Stroke (<?= $stroke_risk; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($stroke_risk)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($stroke_risk)->remain; ?>, your arteries and blood vessels will begin to widen, which can protect you against blood clots and smoking-related stroke.</p>
            <?php }else{ ?>
            <p>Your arteries and blood vessels begin to widen, which can protect you against blood clots and smoking-related stroke.</p>
            <?php } ?>
         </div>
      </div>


  <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($lung_cancer)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Decreased Risk of Lung Cancer (<?= $lung_cancer; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($lung_cancer)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($lung_cancer)->remain; ?>, your risk of being diagnosed with lung cancer will be 50% less than that of a smoker.</p>
            <?php }else{ ?>
            <p>Your risk of being diagnosed with lung cancer is 50% less than that of a smoker. You have also decreased your risk of cancer of the mouth,
throat, and esophagus even more.</p>
<?php } ?>
         </div>
      </div>


   <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($oral_health_years)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Oral Health (<?= $oral_health_years; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($oral_health_years)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($oral_health_years)->remain; ?>, you will no longer be at risk of losing your teeth because of smoking.</p>
            <?php }else{ ?>
            <p>You are no longer at risk of losing your teeth because of smoking.</p>
            <?php } ?>
         </div>
      </div>


  <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($heart_pancreatic)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Improved Heart & Pancreatic Health (<?= $heart_pancreatic; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($heart_pancreatic)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($heart_pancreatic)->remain; ?>, your risk of coronary heart disease and pancreatic cancer will drop to that of a person who has never smoked a cigarette in their life.</p>
            <?php }else{ ?>
            <p>You have cut down your risk of coronary heart disease and pancreatic cancer to that of a person who has never smoked a cigarette in their life.</p>
            <?php } ?>
         </div>
      </div>


     <div class="health-card">
         <div class="health-card-icon">
            <div class="percent">
               <div class="qs_health_percent was" data-percent="<?php echo $qs_smoking->extract_health_data($healthy_lungs)->percent; ?>">
                  <div class="qs_circle_inner">
                     <div class="qs_round_per"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="health-card-content">
            <h3>Healthy Lungs & Body (<?= $healthy_lungs; ?>)</h3>
            <?php if($qs_smoking->extract_health_data($healthy_lungs)->percent < 100){ ?>
            <p>In <?= $qs_smoking->extract_health_data($healthy_lungs)->remain; ?>, your risk of having lung disease, cancer, and pancreatic cancer will be as low as someone who has never smoked a cigarette in their life.</p>
            <?php }else{ ?>
            <p>Your risk of having lung disease, cancer, and pancreatic cancer is now as low as someone who has never smoked a cigarette in their life.</p>
            <?php } ?>
         </div>
      </div>







   </div>
</div>