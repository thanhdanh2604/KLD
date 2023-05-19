<?php
/*
Plugin Name: Simple Plugin Notification
Description: This is a plugin show the link to the new site.
Version: 1.0
Author: Danh
*/
// Register a custom settings page
function my_custom_settings_page() {
  add_options_page(
      'Thông Báo', // Page title
      'Thông Báo', // Menu title
      'manage_options', // Capability required to access the page
      'my-custom-settings', // Page slug
      'my_custom_settings_callback' // Callback function to render the settings page
  );
}
add_action('admin_menu', 'my_custom_settings_page');

// Register and initialize the custom settings
function my_custom_settings_init() {
  // Register a section
  add_settings_section(
      'my_custom_settings_section', // Section ID
      '', // Section title
      'my_custom_settings_section_callback', // Callback function to render the section
      'my-custom-settings' // Page slug of the settings page
  );

  // Register a field
  add_settings_field(
      'thong_bao_text_field', // Field ID
      'Thông báo chuyển đổi trang', // Field label
      'thong_bao_text_field_callback', // Callback function to render the field
      'my-custom-settings', // Page slug of the settings page
      'my_custom_settings_section' // Section ID
  );

  // Register the field's value
  register_setting(
      'my_custom_settings_group', // Option group
      'thong_bao_text_field' // Option name
  );
}
add_action('admin_init', 'my_custom_settings_init');

// Render the custom settings page
function my_custom_settings_callback() {
  ?>
  <div class="wrap">
      <h1>Thông báo của trang</h1>
      <form method="post" action="options.php">
          <?php
          settings_fields('my_custom_settings_group');
          do_settings_sections('my-custom-settings');
          submit_button();
          ?>
      </form>
  </div>
  <?php
}

function my_custom_settings_section_callback() {
  echo 'Phần thông báo này sẽ hiển thị ở phần Header Top.';
}

//After Header 
// Render the field
function thong_bao_text_field_callback() {
  $value = get_option('thong_bao_text_field');
  echo '<textarea style="width:200px;height:100px" name="thong_bao_text_field"  />' . esc_attr($value) .'</textarea>';
}

// Thêm một div sau header
function add_custom_div_after_header($content) {
  
  
      $custom_div = '<div class="top-header">Đây là nội dung của custom div</div>';
      $content = str_replace('</header>', '</header>' . $custom_div, $content);
  
  return $content;
}
add_filter('the_content', 'add_custom_div_after_header');