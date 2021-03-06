<?php 
//Getting Theme Templete

require_once ( get_stylesheet_directory() . '/theme-options.php' );


//Example 

//echo get_current_template();
//echo '<br />';

// breadcrumbs

function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo "</a> » ";
		if (is_category() || is_single()) {
		//	the_category('title_li=');
		//print_r(get_the_category());
		$_SERVER['REQUEST_URI_PATH'] = preg_replace('/\\?.*/', '', $_SERVER['REQUEST_URI']);
//		echo "<br/>server=".$_SERVER['REQUEST_URI_PATH'];
		$url_segments= split('/',$_SERVER['REQUEST_URI_PATH']);
		$total = count($url_segments);
//		echo "<br/>count= ". $total;
		if(is_single())
		{
			$category_slug = $url_segments[$total-3];
		}
		else if(is_category())
		{
			$category_slug = $url_segments[$total-2];	
		}
//		echo "<br/>Category slug = ". $category_slug;
		$cat_info= get_category_by_slug( $category_slug );
//		echo "<pre>";
//		print_r($cat_info);
//		echo "</pre>";
		// Type cast for easy handling
		$cat_info = (array) $cat_info;
		$cat_name = $cat_info['name'];
		//echo "<br/>Category name = ". $cat_name;
		echo $cat_name;
			if (is_single()) {
				echo " » ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
}



// widget

class announcement extends WP_Widget {  
        function announcement() {  
            parent::WP_Widget(false, 'Announcement');  
        }  
    function form($instance) {  
            // outputs the options form on admin
			$title = esc_attr($instance['title']);
        }
    
    function update($new_instance, $old_instance) {
		$title = esc_attr($instance['title']);
            // processes widget options to be saved  
            return $new_instance;  
        }  
    function widget($args, $instance) {
		?>
<div class="sections">
        		<h2 class="announce"><img src="<?php bloginfo('template_url'); ?>/images/announcment-icon.jpg" alt=" " width="36" height="31" align="left" />Announcements</h2>
            	<span>Important News and Events to know</span>
        		<img src="<?php bloginfo('template_url'); ?>/images/resource-sep.jpg" width="300" height="2" alt="" />
                
                <?php $my_query = new WP_Query("category_name=announcements&posts_per_page=5");
  					while ($my_query->have_posts()) : $my_query->the_post(); ?>
  <div class="sec-res">
  
            		<p><?php the_title(); ?></p>
            		<img src="<?php bloginfo('template_url'); ?>/images/date-icon.jpg" alt="" align="texttop" /> <strong class="blue"><?php the_date(); ?></strong>
                    </div>
                    <?php endwhile; ?> 
			<?php wp_reset_query(); ?>
            
			<a href="?page_id=46"><strong class="more-articles">See more Articles</strong></a></div>
      <?php      // outputs the content of the widget  
        }  
    }  
register_widget('announcement');

function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}


// geting Slug

function getSlug() {
	$catSlug = get_category(get_query_var('cat'))->slug;
	return $catSlug;
}

/*
single_cat_title(''); 
single_cat_title('You are reading about ').'<br />'; 
echo $current_category = single_cat_title("", false).'<br />'; ;
*/

// catching image from the Post Content

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = bloginfo('template_directory')."/images/default.jpg";
  }
  return $first_img;
  // Usage :  <img src=" phpStart echo catch_that_image(); phpEnd"  />
}

function catch_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  return $first_img;
  // Usage :  <img src=" phpStart echo catch_image(); phpEnd"  />
}

// limiting the string 

// Way One :

//	$title = get_the_title();
//	$title = strip_tags($title);
//	echo substr($title, 0, 32);

// Way Second :	by function 

function showBrief($str, $length) {
  //$str = strip_tags($str);
	$str = preg_replace("/\< *[img][^\>]*[.]*\>/i","",$str,1);
	$str = explode(" ", $str);
	return implode(" " , array_slice($str, 0, $length));
}

// Two Colors 

function multiColor($title,$position){
	$title = explode(" ",$title );
	$count = count($title);
	for($i=0 ; $i < $count ; $i++){
		if($i == $position)echo '<span>';
		echo $title[$i].' ';
		if($i == ($count-1))echo '</span>';
	}
}


// Get Page ID by name, slug or title

function get_page_id($name)
{
global $wpdb;
// get page id using custom query
$page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE ( post_name = '".$name."' or post_title = '".$name."' ) and post_status = 'publish' and post_type='page' ");
return $page_id;
}

// End

// Get Page Permalink by name, slug or title

function get_page_permalink($name)
{
$page_id = get_page_id($name);
return get_permalink($page_id);
}

// End


// Get From the URL Slug

function getSlugFromUrl()
{
	return (basename(get_permalink()));
}

// End

// Get From the URL Slug

function getIdBySlug($slugName)
{ 	
	$idObj = get_category_by_slug($slugName); 
  	$id = $idObj->term_id;
	return $id;
}



if(!function_exists('getPageContent'))
{
	function getPageContent($pageId)
	{
		if(!is_numeric($pageId))
		{
			return;
		}
		global $wpdb;
		$sql_query = 'SELECT DISTINCT * FROM ' . $wpdb->posts .
		' WHERE ' . $wpdb->posts . '.ID=' . $pageId;
		$posts = $wpdb->get_results($sql_query);
		if(!empty($posts))
		{
			foreach($posts as $post)
			{
				return nl2br($post->post_content);
			}
		}
	}
}


function remove_image_content($content) {
return preg_replace("/\< *[img][^\>]*[.]*\>/i","",$content,1);
}

// e.g add_filter('the_content', 'remove_image_content');

//

function attachment_url_extra( $form_fields, $post ) {
	// input field relates to attachments
        // my_field and _my_field is what you should replace with your own
	$post->post_type == 'attachment';
	$form_fields[ 'my_field' ] = array(
		'label' => __( 'MY FIELD' ),
		'input' => 'text',
		'value' => get_post_meta( $post->ID, '_my_field', true )
	);
	$form_fields[ 'my_field' ][ 'label' ] = __( 'MY FIELD' );
	$form_fields[ 'my_field' ][ 'input' ] = 'text';
	$form_fields[ 'my_field' ][ 'value' ] = get_post_meta( $post->ID, '_my_field', true );

	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'attachment_url_extra', NULL, 2 );

function attachment_url_extra_save( $post, $attachment ) {

	if( isset( $attachment[ 'my_field' ] ) ) {
		if( trim( $attachment[ 'my_field'] ) == '' ) $post[ 'errors' ][ 'my_field' ][ 'errors' ][] = __( 'Error! Something went wrong.' );
		else update_post_meta( $post[ 'ID' ], '_my_field', $attachment[ 'my_field' ] );
	}
	return $post;

}

add_filter( 'attachment_fields_to_save', 'attachment_url_extra_save', NULL, 2 );


add_action( 'right_now_content_table_end' , 'right_now_content_table_end' );

function right_now_content_table_end() {
  $args = array(
    'public' => true ,
    '_builtin' => false
  );
  $output = 'object';
  $operator = 'and';

  $post_types = get_post_types( $args , $output , $operator );

  foreach( $post_types as $post_type ) {
    $num_posts = wp_count_posts( $post_type->name );
    $num = number_format_i18n( $num_posts->publish );
    $text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
    if ( current_user_can( 'edit_posts' ) ) {
      $num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
      $text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
    }
    echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';
    echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';
  }

}

//
$query = "
		SELECT * FROM $wpdb->posts
		LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
		LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
		WHERE $wpdb->terms.slug = 'tvlt-notes'
		AND $wpdb->term_taxonomy.taxonomy = 'tvlt_category'
		AND $wpdb->postmeta.meta_key = 'tvlt_sort'
		AND $wpdb->postmeta.meta_value <> '9999'
 	";

 $tvlt_posts = $wpdb->get_results($query, OBJECT);
//

function category_has_children() {
global $wpdb;	
$term = get_queried_object();
$category_children_check = $wpdb->get_results(" SELECT * FROM wp_term_taxonomy WHERE parent = '$term->term_id' ");
	if ($category_children_check) {
		return true;
	} else {
		return false;
	}
}	

function count_posts($cat_id){
	global $wpdb;
	
	$query = "
		SELECT COUNT(*) FROM $wpdb->posts
		LEFT JOIN $wpdb->term_relationships ON
		($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		LEFT JOIN $wpdb->term_taxonomy ON
		($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		WHERE $wpdb->posts.post_status = 'private'
		AND $wpdb->term_taxonomy.taxonomy = 'category'
		AND $wpdb->term_taxonomy.term_id = $cat_id
	";
	return $wpdb->get_var($query);
}




function add_mime_types($mime_types){
	$mime_types['art'] = 'text/plain';
	return $mime_types;
}
add_filter('upload_mimes', 'add_mime_types', 1, 1);


function getCurrentCatID(){

global $wp_query;

if(is_category() || is_single()){

$cat_ID = get_query_var('cat');
}

return $cat_ID;

}

//

//add this to the functions.php file
add_theme_support( 'post-thumbnails' );

//add this to the functions.php file this to only add to page templates not posts
//add_theme_support( 'post-thumbnails', array( 'page' ) );

//

/*
$args = array('post_type' => 'attachment','numberposts' => -1,'post_parent' => $post->ID); 
$attachments = get_posts($args);
$current_post_thumbnail = get_post_thumbnail_id($id);
							
if($attachments){
     foreach($attachments as $attachment){
          if($attachment->ID == $current_post_thumbnail) continue;
	  echo wp_get_attachment_image($attachment->ID, 'thumbnail' );
	  break;
     }
}
*/

//Setup DB
function lmcb_create_db_table(){
	global $wpdb;
	$lmcb_db_version = "1.0";
				
	$table_name = $wpdb->prefix . "band_info";
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
				
		$sql = "CREATE TABLE " . $table_name . " (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				option_name VARCHAR(150) NOT NULL,
				option_value TEXT NOT NULL,
				UNIQUE KEY id (id)
				);";
					
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		add_option("lmcb_db_version", $lmcb_db_version);
		
		//Band Options
		$band_info_options = array('main_image','description');
		foreach($band_info_options as $option){
			$wpdb->insert($table_name, array('option_name' => $option, 'option_value' => ''));
		}	
	}
}

global $test_db_version;
$test_db_version = "1.0";

function test_create_db_table() {
global $wpdb;
global $test_db_version;

$table_name = $wpdb->prefix . "test_table";
if($wpdb->get_var("show tables like '$table_name'") != $table_name) {

$sql = "CREATE TABLE " . $table_name . " (
id mediumint(9) NOT NULL AUTO_INCREMENT,
time varchar(11) NOT NULL,
title text NOT NULL,
body text NOT NULL,
UNIQUE KEY id (id)
);";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);

add_option("test_db_version", $test_db_version);
}
}

function test_add_row(){
global $wpdb;
$table_name = $wpdb->prefix . "test_table";

$test_title = "The Title";
$test_body = "The Body Text";

$rows_affected = $wpdb->insert( $table_name, array( 'time' => date("m-d-Y"), 'title' => $test_title, 'body' => $test_body ) );
}

add_action('init','test_create_db_table');
/* Uncomment this action to initiate a new row
Just replcace wp_login with the hook of your choice
add_action('wp_login','test_add_row');
*/

add_action('init','lmcb_create_db_table');	
					
function lmcb_to_band_info_db(){
	global $wpdb;
	
	$table_name = $wpdb->prefix . "band_info";
	foreach($_POST as $key => $value){
		$wpdb->update($table_name, array('option_value' => $value), array('option_name' => $key));
	}			
}


add_action("admin_init", "admin_init");
 
function admin_init(){
    //add_meta_box("prodInfo-meta", "Featured Options", "featured_options", "tg_blog", "side", "low");
	//add_meta_box("subtitle-meta", "Subtitle", "subtitle_options", 'post', "side", "low");
	//add_meta_box("priceBox-meta", "Add Price", "priceBox", 'product', "side", "low");
}
//my featured product function 
function featured_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$featured = (bool) $custom["featured"][0];
?>
<label>Check If The Product if featured:</label><input name="featured" type="checkbox" <?php if ( $featured ) {
?>checked="checked"<?php
} ?> />

<?php
 }
//my header slide area

function subtitle_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$subtitle = (string) $custom["subtitle"][0];
?>
<label>Sub Title </label><br /><input name="subtitle" type="text" <?php if ($subtitle ) {
?> value="<?php echo $subtitle ; ?>"<?php
} ?>  />
<?php

}



add_action('save_post', 'save_details');


function save_details(){
  global $post;
  // update_post_meta($post->ID, "featured", (bool) $_POST['featured']);
  // update_post_meta($post->ID, "subtitle", (string)  $_POST['subtitle']);
   update_post_meta($post->ID, "priceBox", (string)  $_POST['priceBox']);

}

//ponka
//add_action("manage_posts_custom_column",  "products_custom_columns");
//add_filter("manage_edit-".'product'."_columns", "products_edit_columns");
 
function products_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Title",
    "description" => "Description",
    "featured" => "Featured",
	"tg_blog_category" => "Categories",
  ); 
  return $columns;

}
function products_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
   
	case "featured":
      $custom = get_post_custom();
	  if ($custom["featured"][0]==1){
		  echo 'Featured';
		}
		else {
			echo 'Not Featured';
		}
      
      break;
    case "tg_blog_category":
      echo get_the_term_list($post->ID, 'tg_blog_category', '', ', ','');
      break;
  }
}


function insert_complogo($file_handler,$user_id,$setthumb='false') {
// check to make sure its a successful upload
if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

$attach_id = media_handle_upload( $file_handler, $user_id );

if ($setthumb) update_usermeta($user_id,'_thumbnail_id',$attach_id);
return $attach_id;
}


add_action('admin_menu', 'create_theme_options_page');
add_action('admin_init', 'register_and_build_fields');
 
function create_theme_options_page() {
  // add_options_page('New Options', 'New Options', 'administrator', __FILE__, 'options_page_fn');
}
 
function register_and_build_fields() {
   register_setting('plugin_options', 'plugin_options', 'validate_setting');
 
   add_settings_section('main_section', 'Main Settings', 'section_cb', __FILE__);
 
   add_settings_field('color_scheme', 'Color Scheme:', 'color_scheme_setting', __FILE__, 'main_section');
   add_settings_field('logo', 'Logo:', 'logo_setting', __FILE__, 'main_section'); // LOGO
   add_settings_field('banner_heading', 'Banner Heading:', 'banner_heading_setting', __FILE__, 'main_section');
   add_settings_field('adverting_information', 'Advertising Info:', 'advertising_information_setting', __FILE__, 'main_section');
 
   add_settings_field('ad_one', 'Ad:', 'ad_setting_one', __FILE__, 'main_section'); // Ad1
   add_settings_field('ad_two', 'Second Ad:', 'ad_setting_two', __FILE__, 'main_section'); // Ad2
}
 
function options_page_fn() {
?>
   <div id="theme-options-wrap" class="widefat">
      <div class="icon32" id="icon-tools"></div>
 
      <h2>My Theme Options</h2>
      <p>Take control of your theme, by overriding the default settings with your own specific preferences.</p>
 
      <form method="post" action="options.php" enctype="multipart/form-data">
         <?php settings_fields('plugin_options'); ?>
         <?php do_settings_sections(__FILE__); ?>
         <p class="submit">
            <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
         </p>
   </form>
</div>
<?php
}
 
// Banner Heading
function banner_heading_setting() {
   $options = get_option('plugin_options');
   echo "<input name='plugin_options[banner_heading]' type='text' value='{$options['banner_heading']}' />";
}
 
// Color Scheme
function color_scheme_setting() {
   $options = get_option('plugin_options');
   $items = array("Red", "Green", "Blue");
 
   echo "<select name='plugin_options[color_scheme]'>";
   foreach ($items as $item) {
      $selected = ( $options['color_scheme'] === $item ) ? 'selected = "selected"' : '';
      echo "<option value='$item' $selected>$item</option>";
   }
   echo "</select>";
}
 
// Advertising info
function advertising_information_setting() {
   $options = get_option('plugin_options');
   echo "<textarea name='plugin_options[advertising_information]' rows='10' cols='60' type='textarea'>{$options['advertising_information']}</textarea>";
}
 
// Ad one
function ad_setting_one() {
   echo '<input type="file" name="ad_one" />';
}
 
// Ad two
function ad_setting_two() {
   echo '<input type="file" name="ad_two" />';
}
 
// Logo
function logo_setting() {
   echo '<input type="file" name="logo" />';
}
 
function validate_setting($plugin_options) {
   $keys = array_keys($_FILES);
   $i = 0;
 
   foreach ($_FILES as $image) {
      // if a files was upload
      if ($image['size']) {
         // if it is an image
         if (preg_match('/(jpg|jpeg|png|gif)$/', $image['type'])) {
            $override = array('test_form' => false);
            $file = wp_handle_upload($image, $override);
 
            $plugin_options[$keys[$i]] = $file['url'];
         } else {
            $options = get_option('plugin_options');
            $plugin_options[$keys[$i]] = $options[$logo];
            wp_die('No image was uploaded.');
         }
      }
 
      // else, retain the image that's already on file.
      else {
         $options = get_option('plugin_options');
         $plugin_options[$keys[$i]] = $options[$keys[$i]];
      }
      $i++;
   }
 
   return $plugin_options;
}
 
function section_cb() {}
 
// Add stylesheet
add_action('admin_head', 'admin_register_head');
 
function admin_register_head() {
   $url = get_bloginfo('template_directory') . '/functions/options_page.css';
   echo "<link rel='stylesheet' href='$url' />\n";
}

global $options;
$options = get_option('cOptn');

function post_content($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}





function my_attachments( $attachments )
{
  $fields         = array(
    array(
      'name'      => 'title',                         // unique field name
      'type'      => 'text',                          // registered field type
      'label'     => __( 'Title', 'attachments' ),    // label to display
      'default'   => 'title',                         // default value upon selection
    ),
   
  );

  $args = array(

    // title of the meta box (string)
    'label'         => 'My Attachments',

    // all post types to utilize (string|array)
    'post_type'     => array( 'ourlookbook' ),

    // meta box position (string) (normal, side or advanced)
    'position'      => 'normal',

    // meta box priority (string) (high, default, low, core)
    'priority'      => 'high',

    // allowed file type(s) (array) (image|video|text|audio|application)
    'filetype'      => null,  // no filetype limit

    // include a note within the meta box (string)
    'note'          => 'Attach files here!',

    // by default new Attachments will be appended to the list
    // but you can have then prepend if you set this to false
    'append'        => true,

    // text for 'Attach' button in meta box (string)
    'button_text'   => __( 'Attach Files', 'attachments' ),

    // text for modal 'Attach' button (string)
    'modal_text'    => __( 'Attach', 'attachments' ),

    // which tab should be the default in the modal (string) (browse|upload)
    'router'        => 'browse',

    // whether Attachments should set 'Uploaded to' (if not already set)
    'post_parent'   => false,

    // fields array
    'fields'        => $fields,

  );

  $attachments->register( 'my_attachments', $args ); // unique instance name
}

add_action( 'attachments_register', 'my_attachments' );






function meks_time_ago() {
	return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago' );
}




add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Twenty Twelve setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 941, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Twelve 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentytwelve_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	//wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20140318', true );

	$font_url = twentytwelve_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'twentytwelve-fonts', esc_url_raw( $font_url ), array(), null );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses twentytwelve_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Twenty Twelve 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function twentytwelve_mce_css( $mce_css ) {
	$font_url = twentytwelve_get_font_url();

	if ( empty( $font_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'twentytwelve_mce_css' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentytwelve' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
			$classes[] = 'custom-background-white';
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function twentytwelve_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_customize_preview_js() {
	wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}
add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );



// My coding here //



add_action('init', 'homeboxes');
function homeboxes() {
	$labels = array(
		'name' => _x('Home Boxes', 'post type general name'),
		'singular_name' => _x('Home Boxes', 'post type singular name'),
		'add_new' => _x('Add New', 'Home Boxes item'),
		'add_new_item' => __('Add New Home Boxes Item'),
		'edit_item' => __('Edit Home Boxes Item'),
		'new_item' => __('New Home Boxes Item'),
		'view_item' => __('View Home Boxes Item'),
		'search_items' => __('Search Portfolio'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		//'supports' => array('title','editor','author','thumbnail','post-thumbnails','excerpts','trackbacks','custom-fields','comments','revisions','page-attributes')
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'homeboxes' , $args );
}