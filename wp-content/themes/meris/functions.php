<?php

define( 'MERIS_THEME_BASE_URL', get_template_directory_uri());
define( 'MERIS_OPTIONS_FRAMEWORK', get_template_directory().'/admin/' ); 
define( 'MERIS_OPTIONS_FRAMEWORK_URI',  MERIS_THEME_BASE_URL. '/admin/'); 
define('MERIS_OPTIONS_PREFIXED' ,'meris_');

/**
 * Required: include options framework.
 */
 
load_template( trailingslashit( get_template_directory() ) . 'admin/options-framework.php' );

/**
 * Theme setup
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-setup.php' );

/**
 * Theme Functions
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-functions.php' );

/**
 * Theme breadcrumb
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/class-breadcrumb.php');
/**
 * Theme widget
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-widget.php' );
/**
 * Theme Metabox
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/metabox-options.php' );

function get_the_twitter_excerpt($length){
$excerpt = get_the_excerpt();
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$the_str = substr($excerpt, 0, $length);
return $the_str;
}


function custom_shortcode()
{
	$terms = get_terms('productcat');
?>
<?php

   foreach ($terms as $term) {
      $wpq = array ('taxonomy'=>'productcat','term'=>$term->slug);
      $myquery = new WP_Query ($wpq);
      $article_count = $myquery->post_count;
      ?>
      <div class="row productshowrow headercontentpro">
      <h3><?php echo $term->name; ?></h3>
      <hr>
      </div>
      <div class="row productshowrow">
      <?php
      
      if ($article_count) {
            ?>
            <?php
             while ($myquery->have_posts()) : $myquery->the_post();
            ?>
                
	            <div class="col-sm-4">
				<div class="portfolio-box text-center productlist">
				<a href="#">
				<?php echo the_post_thumbnail(); ?>
				</a>
				<a href="http://localhost/ultimum/product-1/">
				<h3><?php echo get_the_title(); ?></h3>
				</a>
				<p style="margin-bottom:0"><?php echo get_the_twitter_excerpt(100); ?></p>
				</div>
				</div>
                
            <?php
             endwhile;
            ?>
            </div>
            <?php
             
      }
}
?>
<?php
}

add_shortcode( 'show-product', 'custom_shortcode' );
