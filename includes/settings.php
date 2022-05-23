<?php

function enable_qs_input() {
    ?>
    <input name="enable_progress_tool" type="checkbox" value="1" <?php echo get_option("enable_progress_tool") ? 'checked' : ''; ?>>

    <?php
}

function delete_qs_data() {
    ?>
    <input name="delete_progress_tool" type="checkbox" value="1" <?php echo get_option("delete_progress_tool") ? 'checked' : ''; ?>>
    <?php
}
function qs_mepr_data() {
    ?>
    <input name="qs_mepr" type="checkbox" value="1" <?php echo get_option("qs_mepr") ? 'checked' : ''; ?>>
    <?php
}
function qs_mepr_memberships() {
    $args = array(
                    'post_type' => 'memberpressproduct',
                    'posts_per_page' => -1
        );
    $query = get_posts( $args );
    ?>
        <select name="qs_mepr_memberships[]" multiple>
            <option value="">Select membership</option>
    <?php
    if (!empty($query) ):
        $memberships = get_option("qs_mepr_memberships");
        if(!$memberships){
            $memberships = [];
        }
        foreach ($query as $key => $rest):

    ?>
        <option value="<?php echo $rest->ID; ?>" <?php echo in_array($rest->ID,$memberships)  ? 'selected' : ''; ?>><?php echo $rest->post_title; ?></option>
    <?php
        endforeach;
    endif;
    ?>
    </select>
    <?php
}
function display_qs_panel_fields() {
    $smoke = new Quit_smoking_progress();
        add_settings_section("qs-settings-group", QS_TOOL_NAME." Section", null, "qs-plugin-options");
        add_settings_field("enable_progress_tool", "Enable ".QS_TOOL_NAME, "enable_qs_input", "qs-plugin-options", "qs-settings-group");
        add_settings_field("delete_progress_tool", "Delete ".QS_TOOL_NAME." data on deactivation", "delete_qs_data", "qs-plugin-options", "qs-settings-group");
        register_setting("qs-options", "enable_progress_tool");
        register_setting("qs-options", "delete_progress_tool");
    if($smoke->is_memberpress_active())
    {
        add_settings_section("qs-mepr-settings-group", "Notebook Memberpress Section", null, "qs-plugin-options");
        add_settings_field("logger_mepr", "Enable Memberpress Rules", "qs_mepr_data", "qs-plugin-options", "qs-mepr-settings-group");
        add_settings_field("logger_mepr_memberships", "Select membership", "qs_mepr_memberships", "qs-plugin-options", "qs-mepr-settings-group");
        register_setting("qs-options", "qs_mepr");
        register_setting("qs-options", "qs_mepr_memberships");
    }
        
}

add_action("admin_init", "display_qs_panel_fields");


