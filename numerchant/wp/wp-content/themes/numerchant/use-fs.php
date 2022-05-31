<?php
/*
Template name: USeFuncTnzz
*/

get_header(); ?>

<style>
.slider-wrapper { display:none}
</style>


    <div class="content-single">
        	
        <?php 
		//print_r(get_defined_vars());
		echo '<br><strong>Current Templete :</strong>';
		echo get_current_template(); 
		echo '<br><strong>admin_email :</strong>';
bloginfo('admin_email');
echo '<br><strong>atom_url :</strong>';
bloginfo('atom_url');
echo '<br><strong>blogname :</strong>';
bloginfo('blogname');
echo '<br><strong>charset :</strong>';
bloginfo('charset');
echo '<br><strong>comments_atom_url :</strong>';
bloginfo('comments_atom_url');
echo '<br><strong>comments_rss2_url :</strong>';
bloginfo('comments_rss2_url');
echo '<br><strong>description :</strong>';
bloginfo('description');
echo '<br><strong>home :</strong>';
bloginfo('home');
echo '<br><strong>html_type :</strong>';
bloginfo('html_type');
echo '<br><strong>language :</strong>';
bloginfo('language');
echo '<br><strong>name :</strong>';
bloginfo('name');
echo '<br><strong>rdf_url :</strong>';
bloginfo('rdf_url');
echo '<br><strong>rss2_url :</strong>';
bloginfo('rss2_url');
echo '<br><strong>rss_url :</strong>';
bloginfo('rss_url');
echo '<br><strong>site_url :</strong>';
bloginfo('site_url');
echo '<br><strong>stylesheet_directory :</strong>';
bloginfo('stylesheet_directory ');
echo '<br><strong>stylesheet_url :</strong>';
bloginfo('stylesheet_url ');
echo '<br><strong>template_directory :</strong>';
bloginfo('template_directory ');
echo '<br><strong>template_url :</strong>';
bloginfo('template_url');
echo '<br><strong>text_direction :</strong>';
bloginfo('text_direction');
echo '<br><strong>url :</strong>';
bloginfo('url');
echo '<br><strong>version :</strong>';
bloginfo('version');
echo '<br><strong>wpurl :</strong>';
bloginfo('wpurl');
echo '<br><strong>bloginfo_rss :</strong>';
bloginfo_rss();
echo '<br><strong>get_bloginfo :</strong>';
get_bloginfo();
echo '<br><strong>get_bloginfo_rss :</strong>';
get_bloginfo_rss();
echo '<br>';

echo '<pre>
single_cat_title();
single_month_title();
single_post_title();
single_tag_title();
the_search_query();
wp_title();

wp_get_nav_menu();
wp_get_nav_menu_item();
wp_nav_menu();

comments_open();
has_excerpt();
has_tag();
in_the_loop();
is_404();
is_active_sidebar();
is_admin();
is_archive();
is_attachment();
is_author();
is_category();
is_comments_popup();
is_date();
is_day();
is_feed();
is_front_page();
is_home();
is_month();
is_page();
is_page_template();
is_paged();
is_post_type_hierarchical();
is_preview();
is_search();
is_single();
is_singular();
is_sticky();
is_tag();
is_tax();
is_time();
is_trackback();
is_user_logged_in();
is_year();
pings_open();

is_user_logged_in();
wp_login_form();
wp_login_url();
wp_loginout();
wp_logout();
wp_logout_url();
wp_lostpassword_url();
wp_register();
wp_registration_url();

wp_dropdown_categories();
wp_dropdown_pages();
wp_dropdown_users();
wp_get_archives();
wp_list_authors();
wp_list_bookmarks();
wp_list_categories();
wp_list_comments();
wp_list_pages();
wp_page_menu();

get_posts();
query_posts();
rewind_posts();
wp_reset_query();

get_permalink();
get_post_permalink();
permalink_anchor();
permalink_single_rss();
post_permalink();
the_permalink();

the_shortlink();
wp_get_shortlink();
wp_shortlink_header();
wp_shortlink_wp_head();

edit_bookmark_link();
edit_comment_link();
edit_post_link();
edit_tag_link();

body_class();
next_image_link();
next_post_link();
next_posts_link();
post_class();
post_password_required();
posts_nav_link();
previous_image_link();
previous_post_link();
previous_posts_link();
single_post_title();
sticky_class();
the_category();
the_category_rss();
the_content();
the_content_rss();
the_excerpt();
the_excerpt_rss();
the_ID();
the_meta();
the_shortlink();
the_tags();
the_title();
the_title_attribute();
the_title_rss();
wp_link_pages();

get_post_thumbnail_id();
get_the_post_thumbnail();
has_post_thumbnail();
the_post_thumbnail();

category_description();
single_cat_title();
the_category();
the_category_rss();
wp_dropdown_categories();
wp_list_categories();

single_tag_title();
tag_description();
the_tags();
wp_generate_tag_cloud();
wp_tag_cloud();

the_author();
the_author_link();
get_the_author_link();
the_author_meta();
the_author_posts();
the_author_posts_link();
wp_dropdown_users();
wp_list_authors();

get_calendar();
get_the_date();
single_month_title();
the_date();
the_date_xml();
the_modified_author();
the_modified_date();
the_modified_time();
the_time();

cancel_comment_reply_link();
comment_author();
comment_author_email();
comment_author_email_link();
comment_author_IP();
comment_author_link();
comment_author_rss();
comment_author_url();
comment_author_url_link();
comment_class();
comment_date();
comment_excerpt();
comment_form_title();
comment_form();
comment_ID();
comment_id_fields();
comment_reply_link();
comment_text();
comment_text_rss();
comment_time();
comment_type();
comments_link();
comments_number();
comments_popup_link();
comments_popup_script();
comments_rss_link();
get_avatar();
next_comments_link();
paginate_comments_links();
permalink_comments_rss();
previous_comments_link();
wp_list_comments();

get_bookmark();
get_bookmark_field();
get_bookmarks();
wp_list_bookmarks();

get_attachment_link();
is_attachment();
the_attachment_link();
wp_attachment_is_image();
wp_get_attachment_image();
wp_get_attachment_image_src();
wp_get_attachment_metadata();

get_admin_url();
get_home_url();
get_search_link();
get_site_url();
home_url();
the_feed_link();
wp_ajaxurl();

</pre>';
		?>
          
        <?php  comments_template( '', true ); ?> 
          
          
          

   	</div>
        


<?php get_footer();  ?>