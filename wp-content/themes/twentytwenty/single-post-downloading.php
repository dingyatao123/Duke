<?php
$thisid = $post -> ID;

get_header();

$post_name = get_post( $thisid )->post_name;

$pageid = isset( $_REQUEST['pageid'] )? intval($_REQUEST['pageid']):1;
$per_page = 4;

$args = array(
	'post_type' 	 => 'download',
	'orderby'   	 => 'date',
	'order'   	 => 'desc',
	'posts_per_page' => -1
);
$wp_query = new WP_Query($args);
$num = $wp_query->post_count;
$max_page = ceil($num/$per_page);//页数

function mo_paging($post_name,$pageid,$max_page,$per_page) {
    $p = 3;
	
    if ( $max_page <= 1 ) return; 
    echo '<div class="pagination"><ul>';
	if ( empty( $pageid ) ) $pageid = 1;
    echo '<li class="prev-page">'; previous_posts_link('上一页'); echo '</li>';
    if ( $pageid > $p + 1 ) _paging_link( 1, '<li>第一页</li>',$post_name,$per_page);
    if ( $pageid > $p + 2 ) echo "<li><span>···</span></li>";
    for( $i = $pageid - $p; $i <= $pageid + $p; $i++ ) { 
        if ( $i > 0 && $i <= $max_page ) $i == $pageid ? print "<li class=\"active\"><span>{$i}</span></li>" : _paging_link( $i,'',$post_name,$per_page);
    }
    if ( $pageid < $max_page - $p - 1 ) echo "<li><span> ... </span></li>";
    echo '<li class="next-page">'; next_posts_link('下一页'); echo '</li>';
    echo '<li><span>共 '.$max_page.' 页</span></li>';
    echo '</ul></div>';
}

function _paging_link( $i, $title = '',$post_name,$per_page) {
    if ( $title == '' ) $title = "第 {$i} 页";
    echo "<li><a href='".home_url()."/{$post_name}?pageid={$i}'>{$i}</a></li>";
}
?>

<main id="site-content" class="download" role="main">
	<div class="at">
        <img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($thisid), 'full');
        echo $full_image_url[0]; ?>" alt="<?php echo get_post( $thisid )->post_title; ?>" width="100%">
        <div><div><p><?php echo get_post( $thisid )->post_title; ?></p></div></div>
    </div>
	<div class="center">
		<ul class="content">
			<?php
				$args = array(
					'post_type' 	 => 'download',
					'orderby'   	 => 'date',
					'order'   	 => 'desc',
					'posts_per_page' => $per_page,
					'paged' => $pageid
				);
				$slides = new WP_Query($args);
				while ($slides->have_posts()):$slides->the_post(); ?>
				<li>
					<div class="down">
						<a target="_blank" class="CtaButton" href="<?php echo get_post_meta($post->ID, 'bannerpdf', true ); ?>">点击下载<span class="CtaButton-arrow DirectionalArrow DirectionalArrow--right"></span></a>
						<p><?php echo $post->post_excerpt; ?></p>
						<p><?php the_title(); ?></p>
						<div class="clear"></div>
					</div>
					<div class="img">
						<img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');echo $full_image_url[0]; ?>">
						<div class="cont">
							<?php the_content(); ?>
						</div>
						<div class="clear"></div>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
		<?php mo_paging($post_name,$pageid,$max_page,$per_page); ?>
	</div>
</main><!-- #site-content -->

<?php
get_footer();
