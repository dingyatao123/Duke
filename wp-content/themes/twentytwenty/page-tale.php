<?php

$thisid = $post -> ID;
get_header();
?>

<main id="site-content" class="tale" role="main">
	<div class="at">
        <img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($thisid), 'full');
        echo $full_image_url[0]; ?>" alt="<?php echo get_post( $thisid )->post_title; ?>" width="100%">
        <div><div><p><?php the_title(); ?></p></div></div>
    </div>
	<div class="center">
		<div class="stu">
			<p>学生故事</p>
			<div class="box box1 img img1"><div></div></div>
			<div class="box box2">
				<div class="img img2"><div></div></div>
				<div class="box21">
					<div class="img img3"><div></div></div>
					<div class="img img4"><div></div></div>
				</div>
			</div>
			<div class="box box3">
				<div class="img img5"><div></div></div>
				<div class="img img6"><div></div></div>
				<div class="img img7"><div></div></div>
			</div>
			<div class="clear"></div>
			<a class="CtaButton" href="<?php echo get_permalink(323); ?>" style="font-size: 1rem;">查阅全部<span class="CtaButton-arrow DirectionalArrow DirectionalArrow--right"></span></a>
		</div>
		<hr>
		<div class="par">
			<p>家长感言</p>
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
							'terms' => 'jzgy',
						)
					),
					'posts_per_page' => -1
				);
				$slides = new WP_Query($args);
				while ($slides->have_posts()):$slides->the_post(); ?>
					<li>
						<img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');echo $full_image_url[0]; ?>">
						<p><?php the_title(); ?></p>
						<a class="CtaButton" href="<?php echo the_permalink(); ?>" style="font-size: 1rem;">了解更多<span class="CtaButton-arrow DirectionalArrow DirectionalArrow--right"></span></a>
					</li>
				<?php endwhile; ?>
				<div class="clear"></div>
			</ul>
			<a class="CtaButton" href="<?php echo get_permalink(325); ?>" style="font-size: 1rem;">查阅全部<span class="CtaButton-arrow DirectionalArrow DirectionalArrow--right"></span></a>
		</div>
	</div>
</main><!-- #site-content -->
<script>
	var arr=[];
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
		while ($slides->have_posts()):$slides->the_post(); ?>
			arr.push('<?php echo get_post_meta( $post->ID, 'banner', true ); ?>');
	<?php endwhile; ?>


 //给数组对象的原型添加随机打乱，倒序，正序的方法
 Array.prototype.random = function() {
     this.sort(function() {
         return Math.round(Math.random()) - .5 //获取随机的正负数，返回的值正负数决定了sort如何排列
     })
     return this
 }
	//定义将数组渲染的函数
	function write(array) {
		for (let i = 0; i < 8; i++) {
			$(".img"+i+' div').css("background-image",'url('+array[i]+')');
		}
	}

	function stu(){
		arr = arr.random();
		write(arr);
	}
	$(document).ready(function(){
		stu();
		setInterval('stu()', 5000);//5分钟调用一次
	});
</script>
<?php
get_footer();
