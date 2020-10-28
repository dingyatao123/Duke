<?php

$thisid = $post -> ID;
get_header();
$blog_id = get_current_blog_id();
?>

<main id="site-content" class="tale" role="main">
	<div class="at">
        <img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($thisid), 'full');
        echo $full_image_url[0]; ?>" alt="<?php echo get_post( $thisid )->post_title; ?>" width="100%">
        <div><div><p><?php the_title(); ?></p></div></div>
    </div>
	<div class="center">
		<div class="stu">
			<p><?php if($blog_id==1){echo '学生故事';}else{echo 'Student Story';} ?></p>
			<div class="stupc">
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
			</div>
			<div class="stumobile">
				<!-- Swiper -->
				<div class="swiper-container gallery-top">
					<div class="swiper-wrapper">
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
								<div class="swiper-slide" style="background-image:url(<?php echo get_post_meta( $post->ID, 'banner', true ); ?>)">
									<p><?php echo $post->post_title; ?></p>
								</div>
						<?php endwhile; ?>
					</div>
					<!-- Add Arrows -->
					<div class="swiper-button-next swiper-button-white"></div>
					<div class="swiper-button-prev swiper-button-white"></div>
				</div>
				<div class="swiper-container gallery-thumbs">
					<div class="swiper-wrapper">
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
								<div class="swiper-slide" style="background-image:url(<?php echo get_post_meta( $post->ID, 'banner', true ); ?>)"></div>
						<?php endwhile; ?>
					</div>
				</div>
				<!-- Initialize Swiper -->
				<script>
				var galleryTop = new Swiper('.gallery-top', {
					nextButton: '.swiper-button-next',
					prevButton: '.swiper-button-prev',
					spaceBetween: 0
				});
				var galleryThumbs = new Swiper('.gallery-thumbs', {
					spaceBetween: 10,
					centeredSlides: true,
					slidesPerView: 'auto',
					touchRatio: 0.2,
					slideToClickedSlide: true
				});
				galleryTop.params.control = galleryThumbs;
				galleryThumbs.params.control = galleryTop;
				
				</script>
			</div>	
			<div align="center"><a class="CtaButton2" href="<?php echo get_permalink(323); ?>"><p><?php if($blog_id==1){echo '查阅更多学生故事';}else{echo 'Learn More Students Stories';} ?></p></a></div>
		</div>
		<hr>
		<div class="par">
			<p><?php if($blog_id==1){echo '家长感言';}else{echo 'Parents Comments';} ?></p>
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
						<a class="CtaButton" href="<?php echo the_permalink(); ?>"><?php the_title(); ?><span class="CtaButton-arrow DirectionalArrow DirectionalArrow--right"></span></a>
					</li>
				<?php endwhile; ?>
				<div class="clear"></div>
			</ul>
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
