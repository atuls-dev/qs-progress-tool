<?php

function qs_achievements_meta_box() {

    $screens = array( 'qs_achievements' );

    foreach ( $screens as $screen ) {
        add_meta_box(
            'options',
            __( 'Milestones', QSPROGRESS_TEXTDOMAIN ),
            'qs_achievements_meta_box_callback',
            $screen,'normal', 'high',
		    array(
		        '__block_editor_compatible_meta_box' => true,
		    )
        );
    }
    
}

add_action( 'add_meta_boxes', 'qs_achievements_meta_box' );

function qs_achievements_meta_box_callback($object)
{
	global $qs_smoking;
	$type_fields = $qs_smoking->qs_meta_fields();

    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div class="qs_custom_meta_boxes">
        	
            <div class="qs_meta_inputs ">
            	<div class="qs_meta_inputs_half">
		            <label for="achievement_type">Type</label>
		            <select name="achievement_type" id="achievement_type">
		            	<?php
		            		foreach ($type_fields as $meta_key => $meta_group) {
                                $label = ucwords(str_replace("_", " ", $meta_key));
                                echo '<optgroup label="'.$label.'">';
                                foreach ($meta_group as $groupkey => $gvalue) {
                                    
                                    ?>
                                        <option value="<?php echo $gvalue; ?>" <?php echo ($gvalue == get_post_meta($object->ID, "achievement_type", true))?'selected':''; ?>><?php echo ucfirst($gvalue); ?></option>
                                    <?php
                                   
                                }
                                 echo '</optgroup>';
	            			
		            		}
		            	?>
		            </select>
		        </div>    
	           	<div class="qs_meta_inputs_half ">
	                <label for="achievement_count">Count</label>
	                <input name="achievement_count" type="number"  id="achievement_count" value="<?php echo get_post_meta($object->ID, "achievement_count", true); ?>">
	            </div>
            </div>
		</div>
    <?php  
}

function save_qs_achievements_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = array( 'qs_achievements' );

    if(!in_array($post->post_type, $slug))
        return $post_id;

    $achievement_type = "";
    if(isset($_POST["achievement_type"]))
	    {
	        $achievement_type = $_POST["achievement_type"];
	    }   
    update_post_meta($post_id, "achievement_type", $achievement_type);
    $achievement_count = "";
    if(isset($_POST["achievement_count"]))
        {
            $achievement_count = $_POST["achievement_count"];
        }   
    update_post_meta($post_id, "achievement_count", $achievement_count);
    
    
}

add_action("save_post", "save_qs_achievements_meta_box", 10, 3);