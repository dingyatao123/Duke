<?php

$thisid = $post -> ID;
get_header();
?>

<main id="site-content" class="student" role="main">
	<div class="at">
        <img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($thisid), 'full');
        echo $full_image_url[0]; ?>" alt="<?php echo get_post( $thisid )->post_title; ?>" width="100%">
        <div><div><p><?php the_title(); ?></p></div></div>
    </div>
	<div class="center">
		<ul>
		<?php
			$args = array(
				'post_type' 	 => 'story',
				'orderby'   	 => 'date',
				'order'   	 => 'desc',
				'tax_query' => array(
					array(
						'taxonomy' => 'category_story',
						'field' => 'slug', //can be set to ID
						'terms' => 'xsgs',
					)
				),
				'posts_per_page' => -1
			);
			$slides = new WP_Query($args);
			$i=0;
			while ($slides->have_posts()):$slides->the_post(); ?>
			<li <?php if($i%4==3){ echo 'class="l4"';} ?>>	
				<img src="<?php echo get_post_meta( $post->ID, 'banner', true ); ?>">
				<div class="tt"><?php the_title(); ?></div>
				<div class="ex"><?php the_excerpt(); ?></div>
				<div class="in"><?php echo get_post_meta( $post->ID, 'intro', true ); ?></div>
				<a class="CtaButton" href="<?php the_permalink(); ?>" style="font-size: 1rem;">阅读全文<span class="CtaButton-arrow DirectionalArrow DirectionalArrow--right"></span></a>				
			</li>
		<?php if($i%4==3){ ?>
			<div class="clear"></div>
			<hr>
		<?php }$i++;endwhile; ?>
		</ul>
	</div>
</main><!-- #site-content -->
<?php
get_footer();
