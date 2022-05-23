<?php
class QS_Progress_Controller extends WP_REST_Controller
{
    public function register_routes()
    {
        $version = '1.0';
        $namespace = 'qs-progress/v' . $version;
        $base = 'smoke-free';
        register_rest_route($namespace, '/' . $base . '/', [array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => array(
                $this,
               'get_progress'
            ) ,
            'permission_callback' => array(
                $this,
                'get_progress_permissions_check'
            )
        ) , ]);
        register_rest_route($namespace, '/' . $base . '/(?P<type>[a-zA-Z0-9-]+)', [array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => array(
                $this,
               'get_progress_stats'
            ) ,
            'permission_callback' => array(
                $this,
                'get_progress_permissions_check'
            )
        ) , array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => array(
                $this,
                'update_quit_date'
            ) ,
            'permission_callback' => array(
                $this,
                'quit_date_permissions_check'
            ) ,
            'args' => [],
        ), array(
            'methods' => WP_REST_Server::EDITABLE,
            'callback' => array(
                $this,
                'update_quit_date'
            ) ,
            'permission_callback' => array(
                $this,
                'quit_date_permissions_check'
            ) ,
            'args' => [],
        ) , ]);
        register_rest_route($namespace, '/' . $base . '/(?P<id>[\d]+)', array(
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => array(
                    $this,
                    'get_user_progress'
                ) ,
                'permission_callback' => array(
                    $this,
                    'get_progress_permissions_check'
                )
            ) ,
            array(
                'methods' => WP_REST_Server::EDITABLE,
                'callback' => array(
                    $this,
                    'update_quit_date'
                ) ,
                'permission_callback' => array(
                    $this,
                    'quit_date_permissions_check'
                ) ,
            ) ,
            array(
                'methods' => WP_REST_Server::DELETABLE,
                'callback' => array(
                    $this,
                    'delete_item'
                ) ,
                'permission_callback' => array(
                    $this,
                    'quit_date_permissions_check'
                ) ,
                'args' => array(
                    'force' => array(
                        'default' => false,
                    ) ,
                ) ,
            ) ,
        ));

    }
    public function get_progress_permissions_check($request)
    {
        return is_user_logged_in();

    }
    public function quit_date_permissions_check($request)
    {
        return is_user_logged_in();

    }
    public function get_smoking_data()
    {
    	global $wpdb, $err, $msg;
        $table_name = $wpdb->prefix . 'qs_progress';
        $sql = sprintf("SELECT * FROM %s WHERE `user_id` = %s ", $table_name, get_current_user_id());
        $progress = $wpdb->get_row($sql, ARRAY_A);
        return $progress;
    }
    public function get_user_progress($request)
    {
        global $wpdb, $err, $msg;
        $item = $request->get_params();
        $progress = $this->get_smoking_data();
        if (empty($progress))
        {
            return new WP_Error('empty_logger', 'there is no smoking data for this user ', array(
                'status' => 404
            ));
        }
        $response = new WP_REST_Response($progress);
        $response->set_status(200);
        return $response;
    }
    public function get_progress($request)
    {
    	global $wpdb, $err, $msg;
        $progress = $this->get_smoking_data();

        if (empty($progress))
        {
            return new WP_Error('empty_logger', 'there is no logger data for this user ', array(
                'status' => 404
            ));
        }
        $response = new WP_REST_Response($progress);
        $response->set_status(200);
        return $response;
    }
    public function get_memberships($request)
    {
        $membership = get_option("logger_mepr_memberships");
        $enabled_mepr_rule = get_option("logger_mepr")?true:false;
        $args = array(
                    'post_type' => 'memberpressproduct',
                    'posts_per_page' => -1,
                    'post__in' => $membership
        );
        if($enabled_mepr_rule && !empty($membership)){
            $membershipData = [];
            $query = get_posts( $args );
            if(!empty($query)){
                foreach ($query as $key => $value) {
                    $membershipData[] = array('id'=>$value->ID , 'title'=>$value->post_title);
                }
                $response = new WP_REST_Response($membershipData);
                $response->set_status(200);
                return $response;
            }else{
                return new WP_Error('empty_logger', 'No memberships selected yet ', array(
                    'status' => 404
                ));
            }
        }else{
           return new WP_Error('empty_logger', 'membership module is disabled', array(
                'status' => 404
            ));
        }

    }

    public function update_quit_date($request)
    {
        global $wpdb, $err, $msg;
        $item = $request->get_params();
        extract($item);
        switch ($type) {
            case 'quit-date':
                $data   = array(
                            'quit_date'             => sanitize_text_field($quit_date),
                            'date_format'           => sanitize_text_field($date_format),
                            );
            break;

            case 'cigarette-per-day':
                $data   = array(
                            'cig_per_day'             => sanitize_text_field($cigarettes_per_day),
                            );
            break;
            case 'cigarette-price':
                $data   = array(
                            'cig_pack_price'            => sanitize_text_field($cigarette_price),
                            'currency'                  => sanitize_text_field($currency),
                            );
            break;
       }

       $data = apply_filters('qs_forms_data',$data,$item);
       return $this->update_qs_entry($data);
    }
    public function update_qs_entry($data)
    {
        global $wpdb,$err,$msg;
        $get_smoke_data = $this->get_smoking_data();
        $qs_progress_table = $wpdb->prefix . "qs_progress";
        if(empty($get_smoke_data)){
           $data['user_id'] =  sanitize_text_field(get_current_user_id());
           $result = $wpdb->insert( $qs_progress_table, $data);
           $msg   = 'Successfully Added Quit date';
        }else{
           $result = $wpdb->update( $qs_progress_table, $data , array( 'id' => $get_smoke_data['id']) );
           $msg   = 'Successfully updated Quit date';
        }
        if (false === $result)
        {
            return new WP_Error('cant-create', __('You are not authorize to update quit date', QSPROGRESS_TEXTDOMAIN) , array(
                'status' => 500
            ));

        }else{
            $this_insert = $this->get_smoking_data();
            $success = array(
                'message' => $msg,
                'data' => $this_insert
            );
            $response = new WP_REST_Response($success);
            $response->set_status(200);
            return $response;
        }

    }
    public function get_progress_stats($request)
    {
        global $qs_smoking;
        $item = $request->get_params();
        if($item['type'] != 'stats'){
            return new WP_Error('invalid_param', 'Please specify a valid parameter ', array(
                'status' => 404
            ));
        }
        $smoke_stats            = $qs_smoking->smoke_stats();
        $response = new WP_REST_Response($smoke_stats);
        $response->set_status(200);
        return $response;
    }
    public function delete_item($request)
    {
    	global $wpdb, $err, $msg;
        $item = $request;
        $qs_progress_table = $wpdb->prefix . "qs_progress";
        $results = $wpdb->delete($qs_progress_table, array(
            'id' => $item['id']
        ));
        if ($results)
        {
            return new WP_REST_Response(array(
                'message' => 'Quit date removed successfully'
            ) , 200);
        }
        return new WP_Error('cant-delete', __('You are not authorize to delete item', QSPROGRESS_TEXTDOMAIN) , array(
            'status' => 500
        ));
    }

}
add_action('rest_api_init', function ()
{
    $nl_logger_controller = new QS_Progress_Controller();
    $nl_logger_controller->register_routes();
}); ?>
