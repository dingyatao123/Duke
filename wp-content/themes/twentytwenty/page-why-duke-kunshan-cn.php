<?php

$thisid = $post -> ID;
get_header();
?>

<main id="site-content" class="about" role="main">
	<div class="at">
        <img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($thisid), 'full');
        echo $full_image_url[0]; ?>" alt="<?php echo get_post( $thisid )->post_title; ?>" width="100%">
        <div><div><p><?php echo get_post_meta( $thisid, 'title0', true ); ?></p></div></div>
    </div>
	<div class="center">
		<div class="about1">
			<ul>
				<?php for($i=1;$i<7;$i++){ ?>
					<li>
						<?php echo get_post_meta($thisid, 'intro'.$i, true ); ?>
					</li>
				<?php } ?>
			</ul>
		</div>
		<div class="xz">
			<?php echo get_post_meta( $thisid, 'intro7', true ); ?>
		</div>
		<div class="content">
			<?php for($i=1;$i<5;$i++){ ?>
				<ul class="ul">
					<li><img src="<?php echo get_post_meta($thisid, 'banner'.$i, true ); ?>" alt="duke"></li>
					<li>
						<div>
							<img src="<?php echo get_post_meta($thisid, 'banner'.($i*2+3), true ); ?>" alt="duke">
							<div class="text"><?php echo get_post_meta( $thisid, 'text'.($i*2+3), true ); ?></div>
							<div class="clear"></div>
						</div>
						<div>
							<img src="<?php echo get_post_meta($thisid, 'banner'.($i*2+4), true ); ?>" alt="duke">
							<div class="text"><?php echo get_post_meta( $thisid, 'text'.($i*2+4), true ); ?></div>
							<div class="clear"></div>
						<div>
					</li>
					<div class="clear"></div>
				</ul>
			<?php } ?>
		</div>
	</div>
</main><!-- #site-content -->

<?php
get_footer();
