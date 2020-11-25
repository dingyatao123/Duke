<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
$blog_id = get_current_blog_id();
?>
			<footer id="site-footer" role="contentinfo" class="header-footer-group">
				<div class="container">
					<div class="footer-col-1 footer-column">
						<div class="footer-logo">
							<a href="<?php if($blog_id==3){echo '/en';}else{echo '/';} ?>" target="_blank"><img src="<?php echo get_post_meta(173, 'banner9', true ); ?>" alt="duke"></a>
						</div>
						<div class="footer-socials">
							<?php for($i=1;$i<9;$i++){ ?>
								<?php if($i!=1){?>
									<div class="icon pc">
										<a href="<?php echo get_post_meta(173, 'link'.$i, true ); ?>" target="_blank">
										<img src="<?php echo get_post_meta(173, 'banner'.$i, true ); ?>" alt="<?php echo get_post_meta(173, 'name'.$i, true ); ?>"></a>
									</div>
									<div class="icon mobile">
										<a href="<?php  $j=$i+9; echo get_post_meta(173, 'link'.$i, true ); ?>" target="_blank">
										<img src="<?php echo get_post_meta(173, 'banner'.$j, true ); ?>" alt="<?php echo get_post_meta(173, 'name'.$i, true ); ?>"></a>
									</div>
								<?php }else{ ?>
									<div class="icon pc">
										<img src="<?php echo get_post_meta(173, 'banner'.$i, true ); ?>" alt="<?php echo get_post_meta(173, 'name'.$i, true ); ?>">
										<div class="pop"><img src="<?php echo get_post_meta(173, 'banner25', true ); ?>" alt="<?php echo get_post_meta(173, 'name'.$i, true ); ?>"></div>
									</div>
									<div class="icon mobile">
										<img src="<?php  $j=$i+9;echo get_post_meta(173, 'banner'.$j, true ); ?>" alt="<?php echo get_post_meta(173, 'name'.$i, true ); ?>">
										<div class="pop"><img src="<?php echo get_post_meta(173, 'banner25', true ); ?>" alt="<?php echo get_post_meta(173, 'name'.$i, true ); ?>"></div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
					<?php if ( has_nav_menu( 'footer1' ) ) { ?>
						<div class="footer-col-2 footer-column">
							<div class="content">
								<?php 
									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'footer1',
										)
									);
								?>
							</div>
						</div>
					<?php } ?>
					<?php if ( has_nav_menu( 'footer2' ) ) { ?>
						<div class="footer-col-3 footer-column">
							<div class="content">
								<?php 
									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'footer2',
										)
									);
								?>
							</div>
						</div>
					<?php } ?>
					<?php if ( has_nav_menu( 'footer3' ) ) { ?>
						<div class="footer-col-4 footer-column">
							<div class="content">
								<?php 
									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'footer3',
										)
									);
								?>
							</div>
						</div>
					<?php } ?>
					<div class="clear"></div>
				</div>
				<div class="mobile">
					<div class="footer-logo">
						<img src="<?php echo get_post_meta(173, 'banner9', true ); ?>" alt="duke"></a>
					</div>
					<div id="copyright"><?php echo get_post(173)->post_content; ?></div>
				</div>
			</footer><!-- #site-footer -->
		<?php wp_footer(); ?>
		<script>
			$(document).ready(function(){
				$('.wdkbox .text').click(function(){
					if($(this).hasClass('active')){
						$(this).removeClass('active');
					}else{
						$('.wdkbox .text').removeClass('active');
						$(this).addClass('active');
					}
				});
				$('#site-footer .container .content>li>a').attr('href','javascript: void(0);');
				$('#site-footer .container .footer-column .footer-socials .icon,#dukekunshan3.page-id-32 .notice p').click(function(){
					if($(this).hasClass('active')){
						$(this).removeClass('active');
					}else{
						$(this).addClass('active');
					}
				});
				$('.elementor-32 .swiper-container img').hover(function(){
					var a =$(this).attr('src');
					$(this).attr('src',$(this).attr('src').replace(".jpg","_2.jpg"));
				},function(){
					var a =$(this).attr('src');
					$(this).attr('src',$(this).attr('src').replace("_2.jpg",".jpg"));
				});
				$('#dukekunshan3  .qrcode .elementor-image-box-wrapper').hover(function(){
					$(this).addClass('active');
				},function(){
					$(this).removeClass('active');
				});
				$('#dukekunshan3  .qrcode .elementor-image-box-wrapper').click(function(){
					if($(this).hasClass('active')){
						$(this).removeClass('active');
					}else{
						$(this).addClass('active');
					}
				});

				$('#site-footer .container .content>li>a').click(function(e){
					if($(this).parent().hasClass('sh')){
						$('#site-footer .container .content>li').removeClass('sh');
					}else{
						$('#site-footer .container .content>li').removeClass('sh');
						$(this).parent().addClass('sh');
						e.preventDefault();
					}

				});
				$('.lanicon').click(function(){
					$(".header-titles-wrapper .lan").toggle();
				});
				$('.header-titles-wrapper .lan').click(function(){
					$(this).toggle();
				});
				//滚动条事件
				$(window).scroll(function(){
					scroll();
				});
				scroll();
			});
			//菜单栏始终浮动在顶部
			var navH = $("#site-header").offset().top;//获取要定位元素距离浏览器顶部的距离
			function scroll(){
				//获取滚动条的滑动距离
				var scroH = $(window).scrollTop();
				//滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定
				if(scroH>navH){
					$('.enicon').addClass('fixed');
					$('body').addClass('bfixed');
					$("#site-header").css({"position":"fixed","top":0,"left":0, "z-index":1000, "margin":"0 auto", "width":"100%"});
				}else if(scroH<=navH){
					$('.enicon').removeClass('fixed');
					$('body').removeClass('bfixed');
					$("#site-header").css({"position":"relative","margin":"0 auto"});
				}
				//console.log(scroH==navH);
			}
		</script>
	</body>
</html>
