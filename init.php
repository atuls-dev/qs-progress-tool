<?php
/**
 * Plugin Name: Quit Smoking Progress tool
 * Plugin URI: https://github.com/atuls-dev
 * Description: Quit smoking for good with proven techniques & expert advice to help you stop.
 * Version: 1.1.0
 * Author: Atul
 * Author URI: https://github.com/atuls-dev
 * Text Domain: quit_smoking
 * */
global $qs_smoking;
defined('ABSPATH') or die();
defined('QSPROGRESS')  OR define('QSPROGRESS', plugin_dir_url(__FILE__));
defined('QSPROGRESS_PATH')  OR define('QSPROGRESS_PATH', plugin_dir_path(__FILE__));
defined('QSPROGRESS_TEXTDOMAIN')  OR define('QSPROGRESS_TEXTDOMAIN', 'quit_smoking');
defined('QS_ASSETS_URL')  OR define('QS_ASSETS_URL', QSPROGRESS . 'includes/assets/');
defined('QS_INCLUDE_PATH')  OR define('QS_INCLUDE_PATH', QSPROGRESS_PATH . 'includes/');
defined('QS_TOOL_NAME')  OR define('QS_TOOL_NAME' , 'Quit Smoking');
require QS_INCLUDE_PATH . 'helper.php';



class Quit_smoking_progress {

    public function __construct() {
        add_action('init', array($this, 'init_qs_progress'));
        register_activation_hook(__FILE__, array(__CLASS__, 'qs_progress_activated'));
        register_deactivation_hook(__FILE__, array(__CLASS__, 'qs_progress_deactivated'));
        add_action('wp_enqueue_scripts', array($this, 'qs_assets'));
        add_action( 'admin_enqueue_scripts', array( $this, 'qs_achievements_admin_assets' ));
        add_action('admin_menu', array($this, 'qs_add_menu_pages'));
        add_shortcode("SMOKE_FREE", array($this, "qs_smoke_free"));
        add_shortcode("SMOKE_FREE_STATS", array($this, "qs_smoke_free_stats"));
        add_shortcode("SMOKE_FREE_TIME", array($this, "qs_smoke_free_time"));
        add_shortcode("SMOKE_FREE_ACHIEVE", array($this, "qs_smoke_free_achieve"));
        add_shortcode("SMOKE_FREE_MONEY", array($this, "qs_smoke_free_money"));
        add_shortcode("SMOKE_FREE_HEALTH", array($this, "qs_smoke_free_health"));
        add_shortcode("SMOKE_FREE_DATE", array($this, "qs_smoke_free_date"));
        add_shortcode("TIME_ACHIEVEMENTS", array($this, "qs_time_achievements"));
        add_shortcode("MONEY_ACHIEVEMENTS", array($this, "qs_money_achievements"));
        add_shortcode("CIGARETTE_ACHIEVEMENTS", array($this, "qs_cigarette_achievements"));
        add_action("wp_ajax_qs_add_diary", array($this, "qs_add_diary_function"));
        add_action("wp_ajax_nopriv_qs_add_diary", array($this, "qs_add_diary_function"));
        add_action("wp_ajax_qs_update_achievement", array($this, "qs_update_achievement_function"));
        add_action("wp_ajax_nopriv_qs_update_achievement", array($this, "qs_update_achievement_function"));
        add_action("init" , array($this,'qs_custom_permalinks'));
        add_filter("query_vars",array($this,"qs_query_vars"));
        add_action("template_include",array($this,'qs_static_templates'));
        add_action("wp_footer",array($this,'qs_popup_form' ));

    }
    public function init_qs_progress() {

        if ( ! $this->is_memberpress_active() ) {
            delete_option("qs_mepr");
            delete_option("qs_mepr_memberships");
        }
        require QS_INCLUDE_PATH . 'settings.php';
        require QS_INCLUDE_PATH . 'metabox.php';
    }
    public function qs_progress_activated() {
        require_once( QS_INCLUDE_PATH . "lib/activation.php");
    }

    public function qs_progress_deactivated() {
        require_once( QS_INCLUDE_PATH . "lib/deactivation.php");
    }
    public function qs_assets() {
            $user_data = [];
            if(!empty($this->qs_user_data())):
                foreach ($this->qs_user_data() as $key => $value) {
                   if($key == 'quit_date'){
                        $user_data[$key] = date('Y/m/d h:i:s',strtotime($value));
                   }else{
                        $user_data[$key] = $value;
                   }
                }
            endif;
            wp_register_style('progress_tool_ui_css', QSPROGRESS . 'includes/assets/css/jquery-ui.min.css', array(), time(), 'All');
            wp_enqueue_style('progress_tool_ui_css');
            wp_register_style('progress_tool_custom_css', QSPROGRESS . 'includes/assets/css/style.css', array(), time(), 'All');
            wp_enqueue_style('progress_tool_custom_css');
            wp_register_style('progress_tool_datetime_ios_css', QSPROGRESS . 'includes/assets/css/mobiscroll.javascript.min.css', array(), time(), 'All');
            wp_enqueue_style('progress_tool_datetime_ios_css');
            wp_register_style('swal2_css', QSPROGRESS . 'includes/assets/css/sweetalert2.min.css', array(), time(), 'All');
            wp_enqueue_style('swal2_css');
            wp_register_style('qs_popup_css', QSPROGRESS . 'includes/assets/css/jquery.modal.min.css', array(), time(), 'All');
            wp_enqueue_style('qs_popup_css');
            wp_register_script('qs_jquery_ui', QSPROGRESS . 'includes/assets/js/jquery-ui.min.js', array('jquery'), time(), true);
            wp_enqueue_script('qs_jquery_ui');
            wp_register_script('progress_tool_datetime_ios_js', QSPROGRESS . 'includes/assets/js/mobiscroll.javascript.min.js', array('jquery'), time(), true);
            wp_enqueue_script('progress_tool_datetime_ios_js');
            wp_register_script('swal2_js', QSPROGRESS . 'includes/assets/js/sweetalert2.min.js', array('jquery'), time(), true);
            wp_enqueue_script('swal2_js');
            wp_register_script('qs_validate_js', QSPROGRESS . 'includes/assets/js/jquery.validate.min.js', array('jquery'), time(), true);
            wp_enqueue_script('qs_validate_js');
            wp_register_script('qs_moment', QSPROGRESS . 'includes/assets/js/moment.min.js', array('jquery'), time(), true);
            wp_enqueue_script('qs_moment');
            wp_register_script('qs_popup', QSPROGRESS . 'includes/assets/js/jquery.modal.min.js', array('jquery'), time(), true);
            wp_enqueue_script('qs_popup');
            wp_register_script('progress_tool_common_js', QSPROGRESS . 'includes/assets/js/common.js', array(), time(), true);
            wp_enqueue_script('progress_tool_common_js');
            wp_localize_script('progress_tool_common_js', 'qs_ajax', array('ajaxurl' => admin_url('admin-ajax.php'),'user_data'=>$user_data));


    }
    public function qs_achievements_admin_assets() {
        wp_enqueue_media();
        wp_register_style( 'qs_datatable_style', QSPROGRESS.'includes/assets/css/jquery.dataTables.min.css',array(),time(),'All' );
        wp_enqueue_style( 'qs_datatable_style' );
        wp_register_script('qs_datatable_script', QSPROGRESS . 'includes/assets/js/jquery.dataTables.min.js', array('jquery'), time(), true);
        wp_enqueue_script('qs_datatable_script');
        wp_register_style( 'qs_achievements_meta', QSPROGRESS.'includes/assets/css/meta-box.css',array(),time(),'All' );
        wp_enqueue_style( 'qs_achievements_meta' );
        wp_register_script('progress_tool_admin_js', QSPROGRESS . 'includes/assets/js/admin.js', array(), time(), true);
        wp_enqueue_script('progress_tool_admin_js');
        wp_localize_script('progress_tool_admin_js', 'qs_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));


    }
    public function qs_add_menu_pages() {
        add_menu_page(QS_TOOL_NAME, QS_TOOL_NAME, 'manage_options', 'quit_smoking', array($this, 'qs_main_page_fn'), 'dashicons-heart', 12);
        add_submenu_page('quit_smoking', 'API Endpoints', 'API Endpoints', 'manage_options', 'qs_api_page', array($this, 'qs_api_page_fn'));
        add_submenu_page('quit_smoking', 'Time Achievements', 'Time Achievements', 'manage_options', 'qs_time_achievements', array($this, 'qs_time_achievements_fn'));
        add_submenu_page('quit_smoking', 'Money Achievements', 'Money Achievements', 'manage_options', 'qs_money_achievements', array($this, 'qs_money_achievements_fn'));
        add_submenu_page('quit_smoking', 'Cigarette Achievements', 'Cigarette Achievements', 'manage_options', 'qs_cigarette_achievements', array($this, 'qs_cigarette_achievements_fn'));
        add_submenu_page('quit_smoking', 'Documentation', 'Documentation', 'manage_options', 'qs_documentation', array($this, 'qs_documentation_fn'));

    }



    public function qs_time_achievements_fn() {
        require_once( QS_INCLUDE_PATH . "admin/time.php");
    }

    public function qs_money_achievements_fn() {
        require_once( QS_INCLUDE_PATH . "admin/money.php");
    }

    public function qs_cigarette_achievements_fn() {
        require_once( QS_INCLUDE_PATH . "admin/cigarette.php");
    }
    public function qs_smoke_free($atts = [])
    {
        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );
        return $this->qs_get_template('form',$qs_atts);

    }

    public function qs_smoke_free_stats($atts = [])
    {
        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );

        return $this->qs_get_template('stats',$qs_atts);

    }

    public function qs_smoke_free_time($atts = [])
    {

        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );
        return $this->qs_get_template('smoke_free',$qs_atts);

    }

    public function qs_smoke_free_achieve($atts = [])
    {
        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );
        return $this->qs_get_template('achieve',$qs_atts);
    }

    public function qs_smoke_free_money($atts = [])
    {
        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );
        return $this->qs_get_template('money',$qs_atts);
    }

    public function qs_smoke_free_health($atts = [])
    {
        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );
        return $this->qs_get_template('health',$qs_atts);
    }

    public function qs_smoke_free_date($atts = [])
    {
        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );
        return $this->qs_get_template('date',$qs_atts);
    }

    public function qs_time_achievements($atts = [])
    {
        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );
        return $this->qs_get_template('time_achievements',$qs_atts);
    }
    public function qs_money_achievements($atts = [])
    {
        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );
        return $this->qs_get_template('money_achievements',$qs_atts);
    }
    public function qs_cigarette_achievements($atts = [])
    {
        $qs_atts = shortcode_atts(
                array(
                    'class' => ''
                ), $atts, $tag
        );
        return $this->qs_get_template('cigarette_achievements',$qs_atts);
    }

    public function qs_popup_form()
    {
        echo $this->qs_get_template('secondary_form');
    }


    public function qs_get_template($slug,$qs_atts='')
    {

        if ( is_user_logged_in() ) {
            if($this->check_logger_membership()){
                return;
            }
            $filepath = QS_INCLUDE_PATH . "frontend/{$slug}.php";
            $filepath = apply_filters("qs_smoke_{$slug}_template",$filepath,$this->qs_user_data(),$param);
            ob_start();
            require $filepath;
            return ob_get_clean();
        } else {
            get_template_part ( 'content', 'login' );
            wp_login_form();
        }

    }

    public function qs_add_diary_function()
    {
        extract($_POST);
        switch ($form) {
            case 'cig_quit_form':
                $qdate = $quit_date.' '.$quit_time;

                $qdate  = date('Y-m-d H:i:s',strtotime($qdate));

                $data   = array(
                            'quit_date'             => sanitize_text_field($qdate),
                            'date_format'           => sanitize_text_field($qs_date_format),
                            );
            break;

            case 'cig_per_day_form':
                $data   = array(
                            'cig_per_day'             => sanitize_text_field($cigarettes_per_day),
                            );
            break;
            case 'cig_price_form':
                $data   = array(
                            'cig_pack_price'            => sanitize_text_field($cigarette_price),
                            'currency'                  => sanitize_text_field($currency),
                            );
            break;
       }
       $data = apply_filters('qs_forms_data',$data,$_POST);
       return $this->update_qs_entry($data);

    }


    public function qs_update_achievement_function()
    {
        global $wpdb,$err,$msg;
        $qs_achievement_table = $wpdb->prefix . "qs_achievements";
        extract($_POST);
        $data   = array(
                        'image'            => sanitize_text_field($upload_image),

                        );

        $result = $wpdb->update( $qs_achievement_table, $data , array( 'id' => $id) );
        $msg   = 'Entry Updated successfully';

        if ( false === $result ) {
            echo json_encode(array('status'=>400,'msg'=>'Something went Wrong'));
            die;
        } else {
            echo json_encode(array('status'=>200,'msg'=>$msg));
            die;
        }
    }
    public function qs_api_page_fn() {
        require_once( QS_INCLUDE_PATH . "api/documentation.php");
    }

    public function qs_documentation_fn() {
        require_once( QS_INCLUDE_PATH . "frontend/documentation.php");
    }

    public function qs_custom_permalinks()
    {
       global $wp_rewrite;
       add_rewrite_rule(
            'quit-smoking/achievements',
            'index.php?qspagename=achievements',
            'top'
        );
    }
    public function qs_query_vars($query_vars)
    {
        $query_vars[] = 'qspagename';
        return $query_vars;
    }
    public function qs_static_templates($template)
    {
        if ( get_query_var( 'qspagename' ) == false || get_query_var( 'qspagename' ) == '' ) {
            return $template;
        }
        $qs_page = get_query_var( 'qspagename' );
        $qspages = array('achievements');
        if(in_array($qs_page, $qspages)){
            return QS_INCLUDE_PATH . "frontend/pages/page-{$qs_page}.php";
        }else{
            return $template;
        }

    }


    public function qs_main_page_fn()
    {
        ?>

        <div class="wrap">
            <h1><?php echo QS_TOOL_NAME; ?></h1>
            <form method="post" action="options.php" class="qs-esi-shadow">
                <?php
                settings_fields("qs-options");
                do_settings_sections("qs-plugin-options");
                submit_button();
                ?>
            </form>
            <fieldset class="qs-esi-shadow">
                <legend><h4 class="sec-title">Using Shortcode</h4></legend>
                <p><input onclick="this.select();" readonly="readonly" type="text" value="[SMOKE_FREE]" class="large-text" /></p>
            </fieldset>
            <fieldset class="qs-esi-shadow" style="margin-bottom:0px;">
                <legend><h4 class="sec-title">Using PHP Template Tag</h4></legend>
                <p><strong>Simple Use</strong></p>
                <p>You can add<code> qs_date_popup </code> class to any button to open logger popup</p>
                <p>If you are familiar with PHP code, then you can use PHP Template Tag</p>
                <pre><code>&lt;?php echo do_shortcode('[SMOKE_FREE]'); ?&gt;</code></pre>
            </fieldset>



            <fieldset class="qs-esi-shadow" style="margin-bottom:0px;">
                <legend><h4 class="sec-title"><?php echo QS_TOOL_NAME; ?> Stats Shortcodes</h4></legend>
                <p><strong>Simple Use</strong></p>
                <p>You can use<code>[SMOKE_FREE_STATS]</code> For all stats </p>

                <p>You can use<code>[SMOKE_FREE_TIME]</code> For Time for smoke free </p>

                <p>You can use<code>[SMOKE_FREE_ACHIEVE]</code> For listing Achievement </p>

                <p>You can use<code>[SMOKE_FREE_MONEY]</code> For money saved  </p>

                <p>If you are familiar with PHP code, then you can use PHP Template Tag</p>
                <pre><code>&lt;?php echo do_shortcode('[SMOKE_FREE_STATS]'); ?&gt;</code></pre>
            </fieldset>


        </div>
        <?php
    }


    public function is_memberpress_active()
    {
        if(function_exists('is_plugin_active')){
         if ( is_plugin_active( 'memberpress/memberpress.php' ) )
         {
            return true;
         } else {
            return false;
         }
        }else{
            return false;
        }
    }

    public function qs_user_data()
    {
        global $wpdb, $err, $msg;
        $qs_progress_db_table = $wpdb->prefix . 'qs_progress';
        $sql = sprintf("SELECT * FROM %s WHERE (`user_id` = %s)", $qs_progress_db_table, get_current_user_id());
        $get_smoke_data = $wpdb->get_row($sql, ARRAY_A);
        return $get_smoke_data;
    }

    public function qs_achievements($achievement= null)
    {
        global $wpdb, $err, $msg;
        $qs_achievements_db_table = $wpdb->prefix . 'qs_achievements';
        $sql = sprintf("SELECT * FROM %s WHERE `type` = '%s'", $qs_achievements_db_table, $achievement);
        $get_achievements_data = $wpdb->get_results($sql, ARRAY_A);
        return $get_achievements_data;
    }

    public function check_logger_membership()
    {

        $enabled_mepr_rule = get_option("qs_mepr")?true:false;
        if($enabled_mepr_rule){
            $memberships = get_option("qs_mepr_memberships");
            if(!$memberships){
                $memberships = [];
            }
            $membership = implode(',',$memberships);
            if(!current_user_can("mepr-active","membership:$membership")):
                return true;
            else:
                return false;
            endif;
        }else{
            return false;
        }

    }


    public function qs_quit_days($date)
    {
        $date1_ts = strtotime($date);
        $date2_ts = strtotime(date("Y-m-d H:i:s"));
        if($date1_ts > $date2_ts){
            $diff = $date1_ts - $date2_ts;
        }else{
            $diff = $date2_ts - $date1_ts;
        }
        return $diff / 86400;
    }

    public function qs_future_date()
    {
        $get_smoke_data = $this->qs_user_data();
        extract($get_smoke_data);
        $date1_ts = strtotime($quit_date);
        $date2_ts = strtotime(date("Y-m-d H:i:s"));
        if($date1_ts > $date2_ts){
            return true;
        }else{
            return false;
        }

    }
    public function smoke_stats()
    {
        $get_smoke_data = $this->qs_user_data();
        $getcurrency = $this->qs_currency();
        $smoke_stats            = [];
        if(!empty($get_smoke_data)){
        extract($get_smoke_data);
            $quit_time                                  = $this->qs_quit_days($quit_date);
            $quit_days                                  = round($quit_time);
            $q_minutes                                  = $quit_time*1440;
            $not_smoked                                 = $quit_days*$cig_per_day*2.5;
            $q_time                                     = $this->min_to_time($quit_time*1440);
            $current_time_achievement                   = $this->get_current_achievements('time',$this->qs_future_date() ? 0 : $quit_time*1440);
            $next_time_achievement                      = $this->get_next_achievements('time',$this->qs_future_date() ? 0 : $quit_time*1440);
            $next_time_remaining                        = $this->min_to_time($this->qs_quit_days(date("Y-m-d H:i:s",strtotime($quit_date." +".$next_time_achievement['num_type']." minutes")))*1440);
            $smoke_stats['quit_days']                   = $quit_days;
            $smoke_stats['is_future_date']              = $this->qs_future_date();
            $smoke_stats['cigarette_not_smoked']['cigarette'] = $this->qs_future_date() ? 0 : $quit_days*$cig_per_day;
            $smoke_stats['life_regained']               = $this->qs_future_date() ? 0 : round($quit_days/10);
            $smoke_stats['not_smoked']                  =  $this->qs_future_date() ? $this->min_to_time(0) : $this->min_to_time($not_smoked);
            $smoke_stats['quit_time']                   =  $q_time;
            $smoke_stats['money_saved']['per_day']      = $this->qs_future_date() ? 0 :($cig_pack_price/20)*$cig_per_day;
            $smoke_stats['money_saved']['money']        = $this->qs_future_date() ? 0 :($cig_pack_price/20)*$cig_per_day*$quit_days;
            $smoke_stats['money_saved']['currency']     = $currency;
            $smoke_stats['money_saved']['currency_symbol']     = $getcurrency[$currency]['symbol'];
            $smoke_stats['achievements']['time']['current']                = $current_time_achievement;
            $smoke_stats['achievements']['time']['next']                   = $next_time_achievement;
            $smoke_stats['achievements']['time']['remaining']              = $next_time_remaining;
            $smoke_stats['achievements']['money']['current']               = $this->get_current_achievements('money',$this->qs_future_date() ? 0 :($cig_pack_price/20)*$cig_per_day*$quit_days);
            $smoke_stats['achievements']['money']['next']                  = $this->get_next_achievements('money',$this->qs_future_date() ? 0 :($cig_pack_price/20)*$cig_per_day*$quit_days);
            $smoke_stats['achievements']['cigarette']['current']           = $this->get_current_achievements('cigarette',$this->qs_future_date() ? 0 :$quit_days*$cig_per_day);
            $smoke_stats['achievements']['cigarette']['next']              = $this->get_next_achievements('cigarette',$this->qs_future_date() ? 0 :$quit_days*$cig_per_day);
            $type_fields = $this->qs_meta_fields();
        }
        return apply_filters('qs_smoke_stats',$smoke_stats);
    }
    public function get_current_achievements($type,$num)
    {
        global $wpdb, $err, $msg;
        $qs_achievements_db_table = $wpdb->prefix . 'qs_achievements';
        $sql = sprintf("SELECT * FROM %s WHERE `type` = '%s' AND `num_type` < '%s' order by num_type DESC limit 1", $qs_achievements_db_table, $type,$num);
        $get_achievements_data = $wpdb->get_row($sql, ARRAY_A);
        return $get_achievements_data;
    }
    public function get_next_achievements($type,$num)
    {
        global $wpdb, $err, $msg;
        $qs_achievements_db_table = $wpdb->prefix . 'qs_achievements';
        $sql = sprintf("SELECT * FROM %s WHERE `type` = '%s' AND `num_type` > '%s' order by num_type ASC limit 1", $qs_achievements_db_table, $type,$num);
        $get_achievements_data = $wpdb->get_row($sql, ARRAY_A);
        return $get_achievements_data;
    }

    public function get_all_achievements($type)
    {
        global $wpdb, $err, $msg;
        $qs_achievements_db_table = $wpdb->prefix . 'qs_achievements';
        $sql = sprintf("SELECT * FROM %s WHERE `type` = '%s' order by achievement_order ASC", $qs_achievements_db_table, $type);
        $get_achievements_data = $wpdb->get_results($sql, ARRAY_A);
        return $get_achievements_data;
    }



    public function min_to_time($minutes)
    {
        $Yyear      = floor ($minutes / 525600);
        $Ymonth     = floor (($minutes - $Yyear * 525600) / 43800);
        $Ydays      = floor (($minutes - ($Yyear * 525600)- ($Ymonth*43800)) / 1440);
        $Yhours     = floor (($minutes - ($Yyear * 525600)- ($Ymonth*43800)- ($Ydays*1440)) / 60);
        $Yminutes   = floor (($minutes - ($Yyear * 525600)- ($Ymonth*43800)- ($Ydays*1440)- ($Yhours*60))%60);
        $Yseconds   = floor (($minutes - ($Yyear * 525600)- ($Ymonth*43800)- ($Ydays*1440)- ($Yhours*60) - ($Yminutes)%60)*60);

        $Mmonth     = floor ($minutes / 43800);
        $Mdays      = floor (($minutes - ($Mmonth*43800)) / 1440);
        $Mhours     = floor (($minutes - ($Mmonth*43800)- ($Mdays*1440)) / 60);
        $Mminutes   = floor (($minutes - ($Mmonth*43800)- ($Mdays*1440)- ($Mhours*60))% 60);
        $Mseconds   = floor (($minutes - ($Mmonth*43800)- ($Mdays*1440)- ($Mhours*60)- ($Mminutes)%60)*60);

        $Ddays      = floor (($minutes) / 1440);
        $Dhours     = floor (($minutes - ($Ddays*1440)) / 60);
        $Dminutes   = floor (($minutes - ($Ddays*1440)- ($Dhours*60))% 60);
        $Dseconds   = floor (($minutes - ($Ddays*1440)- ($Dhours*60)- ($Dminutes)%60)*60);

        $Hhours     = floor (($minutes) / 60);
        $Hminutes   = floor (($minutes- ($Hhours*60))%60);
        $Hseconds   = floor (($minutes- ($Hhours*60) - ($Hminutes)%60)*60);
        if($Ddays <= 1){
            $preview = ['hour'=>$Hhours,'minute'=>$Hminutes,'second'=>$Hseconds];
        }else if($Ddays < 90 && $Ddays > 1){
            $preview = ['day'=>$Ddays,'hour'=>$Dhours,'minute'=>$Dminutes];
        }else if($Ddays > 90 && $Ddays < 365 ){
            $preview = ['month'=>$Mmonth,'day'=>$Mdays,'hour'=>$Mhours];
        }else{
            $preview = ['year'=>$Yyear,'month'=>$Ymonth,'day'=>$Ydays];
        }

        if($Ddays <= 1){
            $healthpreview = ['hour'=>$Hhours,'minute'=>$Hminutes];
        }else if($Ddays < 30 && $Ddays > 1){
            $healthpreview = ['day'=>$Ddays,'hour'=>$Dhours];
        }else if($Ddays > 30 && $Ddays < 365 ){
            $healthpreview = ['month'=>$Mmonth,'day'=>$Mdays];
        }else{
            $healthpreview = ['year'=>$Yyear,'month'=>$Ymonth];
        }
        $time = ['InYear'    =>  ['year'=>$Yyear,'month'=>$Ymonth,'day'=>$Ydays,'hour'=>$Yhours,'minute'=>$Yminutes,'second'=>$Yseconds],
                 'InMonth'   =>  ['month'=>$Mmonth,'day'=>$Mdays,'hour'=>$Mhours,'minute'=>$Mminutes,'second'=>$Mseconds],
                 'InDays'    =>  ['day'=>$Ddays,'hour'=>$Dhours,'minute'=>$Dminutes,'second'=>$Dseconds],
                 'InHours'   =>  ['hour'=>$Hhours,'minute'=>$Hminutes,'second'=>$Hseconds],
                 'TotalMinutes' => $minutes,
                 'preview'   =>  $preview,
                 'health'   =>  $healthpreview,
                ];
        array_walk_recursive($time,function(&$item, $key){
            $item = str_pad($item, 2, "0", \STR_PAD_LEFT);
        });
        return $time;

    }
    public function plural($amount)
    {
        return ($amount == 1)?'':'s';
    }
    public function update_qs_entry($data)
    {
        global $wpdb,$err,$msg;
        $get_smoke_data = $this->qs_user_data();
        $qs_progress_table = $wpdb->prefix . "qs_progress";
        if(empty($get_smoke_data)){
           $data['user_id'] =  sanitize_text_field(get_current_user_id());
           $result = $wpdb->insert( $qs_progress_table, $data);
           $msg   = 'Entry added successfully';
        }else{
           $result = $wpdb->update( $qs_progress_table, $data , array( 'id' => $get_smoke_data['id']) );
           $msg   = 'Entry Updated successfully';
        }
        if ( false === $result ) {
            echo json_encode(array('status'=>400,'msg'=>'Something went Wrong'));
            die;
        } else {
            echo json_encode(array('status'=>200,'msg'=>$msg));
            die;
        }

    }
    public function qs_currency()
    {
        $currencies = [
                'USD' => [
                    'name'   => 'United States Dollar',
                    'symbol' => '$',
                ],
                'GBP' => [
                    'name'   => 'United Kingdom Pound',
                    'symbol' => '£',
                ],
                'EUR' => [
                    'name'   => 'Euro Member Countries',
                    'symbol' => '€',
                ],
                'CAD' => [
                    'name'   => 'Canada Dollar',
                    'symbol' => '$',
                ],
                'AUD' => [
                    'name'   => 'Australia Dollar',
                    'symbol' => '$',
                ],
                'ALL' => [
                    'name'   => 'Albania Lek',
                    'symbol' => 'L',
                ],
                'AFN' => [
                    'name'   => 'Afghanistan Afghani',
                    'symbol' => '؋',
                ],
                'ARS' => [
                    'name'   => 'Argentina Peso',
                    'symbol' => '$',
                ],
                'AWG' => [
                    'name'   => 'Aruba Guilder',
                    'symbol' => 'ƒ',
                ],
                'AZN' => [
                    'name'   => 'Azerbaijan New Manat',
                    'symbol' => '₼',
                ],
                'BSD' => [
                    'name'   => 'Bahamas Dollar',
                    'symbol' => '$',
                ],
                'BBD' => [
                    'name'   => 'Barbados Dollar',
                    'symbol' => '$',
                ],
                'BDT' => [
                    'name'   => 'Bangladeshi taka',
                    'symbol' => '৳',
                ],
                'BYR' => [
                    'name'   => 'Belarus Ruble',
                    'symbol' => 'Br',
                ],
                'BZD' => [
                    'name'   => 'Belize Dollar',
                    'symbol' => 'BZ$',
                ],
                'BMD' => [
                    'name'   => 'Bermuda Dollar',
                    'symbol' => '$',
                ],
                'BOB' => [
                    'name'   => 'Bolivia Boliviano',
                    'symbol' => '$b',
                ],
                'BAM' => [
                    'name'   => 'Bosnia and Herzegovina Convertible Marka',
                    'symbol' => 'KM',
                ],
                'BWP' => [
                    'name'   => 'Botswana Pula',
                    'symbol' => 'P',
                ],
                'BGN' => [
                    'name'   => 'Bulgaria Lev',
                    'symbol' => 'лв',
                ],
                'BRL' => [
                    'name'   => 'Brazil Real',
                    'symbol' => 'R$',
                ],
                'BND' => [
                    'name'   => 'Brunei Darussalam Dollar',
                    'symbol' => '$',
                ],
                'KHR' => [
                    'name'   => 'Cambodia Riel',
                    'symbol' => '៛',
                ],

                'KYD' => [
                    'name'   => 'Cayman Islands Dollar',
                    'symbol' => '$',
                ],
                'CLP' => [
                    'name'   => 'Chile Peso',
                    'symbol' => '$',
                ],
                'CNY' => [
                    'name'   => 'China Yuan Renminbi',
                    'symbol' => '¥',
                ],
                'COP' => [
                    'name'   => 'Colombia Peso',
                    'symbol' => '$',
                ],
                'CRC' => [
                    'name'   => 'Costa Rica Colon',
                    'symbol' => '₡',
                ],
                'HRK' => [
                    'name'   => 'Croatia Kuna',
                    'symbol' => 'kn',
                ],
                'CUP' => [
                    'name'   => 'Cuba Peso',
                    'symbol' => '₱',
                ],
                'CZK' => [
                    'name'   => 'Czech Republic Koruna',
                    'symbol' => 'Kč',
                ],
                'DKK' => [
                    'name'   => 'Denmark Krone',
                    'symbol' => 'kr',
                ],
                'DOP' => [
                    'name'   => 'Dominican Republic Peso',
                    'symbol' => 'RD$',
                ],
                'XCD' => [
                    'name'   => 'East Caribbean Dollar',
                    'symbol' => '$',
                ],
                'EGP' => [
                    'name'   => 'Egypt Pound',
                    'symbol' => '£',
                ],
                'SVC' => [
                    'name'   => 'El Salvador Colon',
                    'symbol' => '$',
                ],
                'EEK' => [
                    'name'   => 'Estonia Kroon',
                    'symbol' => 'kr',
                ],

                'FKP' => [
                    'name'   => 'Falkland Islands (Malvinas) Pound',
                    'symbol' => '£',
                ],
                'FJD' => [
                    'name'   => 'Fiji Dollar',
                    'symbol' => '$',
                ],
                'GHC' => [
                    'name'   => 'Ghana Cedis',
                    'symbol' => '₵',
                ],
                'GIP' => [
                    'name'   => 'Gibraltar Pound',
                    'symbol' => '£',
                ],
                'GTQ' => [
                    'name'   => 'Guatemala Quetzal',
                    'symbol' => 'Q',
                ],
                'GGP' => [
                    'name'   => 'Guernsey Pound',
                    'symbol' => '£',
                ],
                'GYD' => [
                    'name'   => 'Guyana Dollar',
                    'symbol' => '$',
                ],
                'HNL' => [
                    'name'   => 'Honduras Lempira',
                    'symbol' => 'L',
                ],
                'HKD' => [
                    'name'   => 'Hong Kong Dollar',
                    'symbol' => '$',
                ],
                'HUF' => [
                    'name'   => 'Hungary Forint',
                    'symbol' => 'Ft',
                ],
                'ISK' => [
                    'name'   => 'Iceland Krona',
                    'symbol' => 'kr',
                ],
                'INR' => [
                    'name'   => 'India Rupee',
                    'symbol' => '&#8377;',
                ],
                'IDR' => [
                    'name'   => 'Indonesia Rupiah',
                    'symbol' => 'Rp',
                ],
                'IRR' => [
                    'name'   => 'Iran Rial',
                    'symbol' => '﷼',
                ],
                'IMP' => [
                    'name'   => 'Isle of Man Pound',
                    'symbol' => '£',
                ],
                'ILS' => [
                    'name'   => 'Israel Shekel',
                    'symbol' => '₪',
                ],
                'JMD' => [
                    'name'   => 'Jamaica Dollar',
                    'symbol' => 'J$',
                ],
                'JPY' => [
                    'name'   => 'Japan Yen',
                    'symbol' => '¥',
                ],
                'JEP' => [
                    'name'   => 'Jersey Pound',
                    'symbol' => '£',
                ],
                'KZT' => [
                    'name'   => 'Kazakhstan Tenge',
                    'symbol' => 'лв',
                ],
                'KPW' => [
                    'name'   => 'Korea (North) Won',
                    'symbol' => '₩',
                ],
                'KRW' => [
                    'name'   => 'Korea (South) Won',
                    'symbol' => '₩',
                ],
                'KWD' => [
                    'name'   => 'Kuwaiti Dinar',
                    'symbol' => 'ك',
                ],
                'KGS' => [
                    'name'   => 'Kyrgyzstan Som',
                    'symbol' => 'лв',
                ],
                'LAK' => [
                    'name'   => 'Laos Kip',
                    'symbol' => '₭',
                ],
                'LVL' => [
                    'name'   => 'Latvia Lat',
                    'symbol' => 'Ls',
                ],
                'LBP' => [
                    'name'   => 'Lebanon Pound',
                    'symbol' => '£',
                ],
                'LRD' => [
                    'name'   => 'Liberia Dollar',
                    'symbol' => '$',
                ],
                'LTL' => [
                    'name'   => 'Lithuania Litas',
                    'symbol' => 'Lt',
                ],
                'MKD' => [
                    'name'   => 'Macedonia Denar',
                    'symbol' => 'ден',
                ],
                'MYR' => [
                    'name'   => 'Malaysia Ringgit',
                    'symbol' => 'RM',
                ],
                'MUR' => [
                    'name'   => 'Mauritius Rupee',
                    'symbol' => '₨',
                ],
                'MXN' => [
                    'name'   => 'Mexico Peso',
                    'symbol' => '$',
                ],
                'MNT' => [
                    'name'   => 'Mongolia Tughrik',
                    'symbol' => '₮',
                ],
                'MZN' => [
                    'name'   => 'Mozambique Metical',
                    'symbol' => 'MT',
                ],
                'NAD' => [
                    'name'   => 'Namibia Dollar',
                    'symbol' => '$',
                ],
                'NPR' => [
                    'name'   => 'Nepal Rupee',
                    'symbol' => '₨',
                ],
                'ANG' => [
                    'name'   => 'Netherlands Antilles Guilder',
                    'symbol' => 'ƒ',
                ],
                'NZD' => [
                    'name'   => 'New Zealand Dollar',
                    'symbol' => '$',
                ],
                'NIO' => [
                    'name'   => 'Nicaragua Cordoba',
                    'symbol' => 'C$',
                ],
                'NGN' => [
                    'name'   => 'Nigeria Naira',
                    'symbol' => '₦',
                ],
                'NOK' => [
                    'name'   => 'Norway Krone',
                    'symbol' => 'kr',
                ],
                'OMR' => [
                    'name'   => 'Oman Rial',
                    'symbol' => '﷼',
                ],
                'PKR' => [
                    'name'   => 'Pakistan Rupee',
                    'symbol' => '₨',
                ],
                'PAB' => [
                    'name'   => 'Panama Balboa',
                    'symbol' => 'B/.',
                ],
                'PYG' => [
                    'name'   => 'Paraguay Guarani',
                    'symbol' => 'Gs',
                ],
                'PEN' => [
                    'name'   => 'Peru Nuevo Sol',
                    'symbol' => 'S/.',
                ],
                'PHP' => [
                    'name'   => 'Philippines Peso',
                    'symbol' => '₱',
                ],
                'PLN' => [
                    'name'   => 'Poland Zloty',
                    'symbol' => 'zł',
                ],
                'QAR' => [
                    'name'   => 'Qatar Riyal',
                    'symbol' => '﷼',
                ],
                'RON' => [
                    'name'   => 'Romania New Leu',
                    'symbol' => 'lei',
                ],
                'RUB' => [
                    'name'   => 'Russia Ruble',
                    'symbol' => '&#8381;',
                ],
                'SHP' => [
                    'name'   => 'Saint Helena Pound',
                    'symbol' => '£',
                ],
                'SAR' => [
                    'name'   => 'Saudi Arabia Riyal',
                    'symbol' => '﷼',
                ],
                'RSD' => [
                    'name'   => 'Serbia Dinar',
                    'symbol' => 'Дин.',
                ],
                'SCR' => [
                    'name'   => 'Seychelles Rupee',
                    'symbol' => '₨',
                ],
                'SGD' => [
                    'name'   => 'Singapore Dollar',
                    'symbol' => '$',
                ],
                'SBD' => [
                    'name'   => 'Solomon Islands Dollar',
                    'symbol' => '$',
                ],
                'SOS' => [
                    'name'   => 'Somalia Shilling',
                    'symbol' => 'S',
                ],
                'ZAR' => [
                    'name'   => 'South Africa Rand',
                    'symbol' => 'R',
                ],
                'LKR' => [
                    'name'   => 'Sri Lanka Rupee',
                    'symbol' => '₨',
                ],
                'SEK' => [
                    'name'   => 'Sweden Krona',
                    'symbol' => 'kr',
                ],
                'CHF' => [
                    'name'   => 'Switzerland Franc',
                    'symbol' => 'CHF',
                ],
                'SRD' => [
                    'name'   => 'Suriname Dollar',
                    'symbol' => '$',
                ],
                'SYP' => [
                    'name'   => 'Syria Pound',
                    'symbol' => '£',
                ],
                'TWD' => [
                    'name'   => 'Taiwan New Dollar',
                    'symbol' => 'NT$',
                ],
                'THB' => [
                    'name'   => 'Thailand Baht',
                    'symbol' => '฿',
                ],
                'TTD' => [
                    'name'   => 'Trinidad and Tobago Dollar',
                    'symbol' => 'TT$',
                ],
                'TRY' => [
                    'name'   => 'Turkey Lira',
                    'symbol' => '₺',
                ],
                'TVD' => [
                    'name'   => 'Tuvalu Dollar',
                    'symbol' => '$',
                ],
                'UAH' => [
                    'name'   => 'Ukraine Hryvna',
                    'symbol' => '₴',
                ],
                'UGX' => [
                    'name'   => 'Uganda Shilling',
                    'symbol' => 'USh',
                ],
                'UYU' => [
                    'name'   => 'Uruguay Peso',
                    'symbol' => '$U',
                ],
                'UZS' => [
                    'name'   => 'Uzbekistan Som',
                    'symbol' => 'лв',
                ],
                'VEF' => [
                    'name'   => 'Venezuela Bolivar',
                    'symbol' => 'Bs',
                ],
                'VND' => [
                    'name'   => 'Viet Nam Dong',
                    'symbol' => '₫',
                ],
                'YER' => [
                    'name'   => 'Yemen Rial',
                    'symbol' => '﷼',
                ],
                'ZWD' => [
                    'name'   => 'Zimbabwe Dollar',
                    'symbol' => 'Z$',
                ],
            ];
        return apply_filters('fs_currency',$currencies);
    }
    public function phpToMoment($format)
    {
         $replacements = [
            'd' => 'DD',
            'D' => 'ddd',
            'j' => 'D',
            'l' => 'dddd',
            'N' => 'E',
            'S' => 'o',
            'w' => 'e',
            'z' => 'DDD',
            'W' => 'W',
            'F' => 'MMMM',
            'm' => 'MM',
            'M' => 'MMM',
            'n' => 'M',
            't' => '', // no equivalent
            'L' => '', // no equivalent
            'o' => 'YYYY',
            'Y' => 'YYYY',
            'y' => 'YY',
            'a' => 'a',
            'A' => 'A',
            'B' => '', // no equivalent
            'g' => 'h',
            'G' => 'H',
            'h' => 'hh',
            'H' => 'HH',
            'i' => 'mm',
            's' => 'ss',
            'u' => 'SSS',
            'e' => 'zz', // deprecated since version 1.6.0 of moment.js
            'I' => '', // no equivalent
            'O' => '', // no equivalent
            'P' => '', // no equivalent
            'T' => '', // no equivalent
            'Z' => '', // no equivalent
            'c' => '', // no equivalent
            'r' => '', // no equivalent
            'U' => 'X',
        ];
        $replacements = apply_filters('phpmoment_conversions',$replacements);
        $momentFormat = strtr($format, $replacements);
        return $momentFormat;
    }

    public function qs_date_format()
    {
        $date_format = array('j F Y'=>'Day, Month, Year', 'F j Y'=>'Month, Day, Year');
        return apply_filters('fs_date_format',$date_format);

    }
    public function qs_meta_fields()
    {
        $meta_fields = [];
        $meta_fields['quit_time']        = ['days','week','month','year'];
        $meta_fields['cigarette_not_smoked']   = ['cigarette'];
        $meta_fields['money_saved']      = ['money'];
        return apply_filters('fs_meta_fields',$meta_fields);
    }

    public function qs_health_card()
    {
        $days['pulse']  = '12 Day';
        $days['blood_pressure']  = '150 Minutes';
        $days['nicotine_level']  = '8 Hours';
        $days['oxygen_level'] = '12 Hours';
        $days['heart_risk']  = '1 Day';
        $days['taste_smell']  = '2 Days';
        $days['body_nicotine']  = '3 Days';
        $days['nicotine_free']  = '5 Days';
        $days['blood_sugar']  = '7 Days';
        $days['sex_drive']  = '10 Days';
        $days['oral_health']  = '12 Days';
        $days['brain_balance']  = '20 Days';
        $days['increased_energy']  = '1 Month';
        $days['imune_system']  = '2 Months';
        $days['lung_capacity']  = '3 Months';
        $days['mental_health']  = '92 Days';
        $days['fertility']  = '100 Days';
        $days['decrease_heart_risk']  = '1 Year';
        $days['cancer_risk']  = '4 Years';
        $days['stroke_risk']  = '5 Years';
        $days['lung_cancer']  = '10 Years';
        $days['oral_health_years']  = '13 Years';
        $days['heart_pancreatic']  = '15 Years';
        $days['healthy_lungs']  = '20 Years';
        return $days;
    }

    public function extract_health_data($value)
    {
        global $qs_smoking;
        $smoke_stats = $qs_smoking->smoke_stats();

        if(strpos($value, "Day") !== false){
            $day = (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT)*1440;

        } else if(strpos($value, "Hour") !== false){
            $day = (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT)*60;

        }else if(strpos($value, "Minute") !== false){
            $day = (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT);

        }else if(strpos($value, "Month") !== false){
            $day = (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT)*43800;

        }else if(strpos($value, "Year") !== false){
            $day = (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT)*525600;

        }
        $quit_hours = $smoke_stats['quit_time']['TotalMinutes'];
        $remain = $day - $quit_hours;
        $remain = $this->min_to_time($remain);
        $htm = '';
        if($smoke_stats['is_future_date']){
            $htm .= $value.' ';
        }else{
            foreach ($remain['health'] as $key => $newvalue) {
                $newvalue = ltrim($newvalue, "0");
                $htm .= $newvalue.' '.$key.$qs_smoking->plural($newvalue).' ';
            }
        }

        $percent = ($quit_hours/$day)*100;
        if($smoke_stats['is_future_date']){
            $percent = 0;
        }else{
            $percent = ($percent > 100)?100:$percent;
        }

        $return =  new stdClass;
        $return->percent = $percent;
        $return->remain = $htm;
        return $return;
    }

}

$qs_smoking = new Quit_smoking_progress();

