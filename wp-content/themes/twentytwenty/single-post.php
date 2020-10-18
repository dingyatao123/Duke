<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" class="<?php echo get_post( $thisid )->post_name; ?>"" role="main">
	<!-- <div class="at">
       <img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($thisid), 'full'); 
        // echo $full_image_url[0]; ?>" alt="<?php echo get_post( $thisid )->post_title; ?>" width="100%">
         <div><div><p><?php the_title(); ?></p></div></div> 
     </div> -->
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
