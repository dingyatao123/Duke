<?php

$thisid = $post -> ID;
get_header();
?>

<main id="site-content" class="student undergraduate" role="main">
	<div class="at">
        <img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($thisid), 'full');
        echo $full_image_url[0]; ?>" alt="<?php echo get_post( $thisid )->post_title; ?>" width="100%">
        <div><div><p><?php the_title(); ?></p></div></div>
    </div>
	<div class="center">
		<ul>
		<?php
			$args = array(
				'post_type' 	 => 'post',
				'orderby'   	 => 'date',
				'order'   	 => 'asc',
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'slug', //can be set to ID
						'terms' => 'bkjy',
					)
				),
				'posts_per_page' => -1
			);
			$slides = new WP_Query($args);
			$i=1;
			while ($slides->have_posts()):$slides->the_post(); ?>
			<li <?php if($i%2==0){ echo 'class="l2"';} ?>>	
				<div class="tt"><span><?php if($i<10){echo 0;}echo $i; ?></span><?php the_title(); ?></div>
				<img src="<?php echo get_post_meta( $post->ID, 'banner', true ); ?>">
				<div class="ex"><?php the_excerpt(); ?></div>
				<p><a class="CtaButton" href="<?php the_permalink(); ?>" style="font-size: 1rem;">了解更多<span class="CtaButton-arrow DirectionalArrow DirectionalArrow--right"></span></a></p>				
			</li>
		<?php if($i%2==0){ ?>
			<div class="clear"></div>
		<?php }$i++;endwhile; ?>
		</ul>
	</div>
</main><!-- #site-content -->
<?php
get_footer();
