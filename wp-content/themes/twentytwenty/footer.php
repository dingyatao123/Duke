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

?>
			<footer id="site-footer" role="contentinfo" class="header-footer-group">
				<div class="container">
					<div class="footer-col-1 footer-column">
						<div class="footer-logo">
							<img src="<?php echo get_post_meta(173, 'banner9', true ); ?>" alt="duke"></a>
						</div>
						<div class="footer-socials">
							<?php for($i=1;$i<9;$i++){ ?>
								<div class="icon pc">
									<a href="<?php echo get_post_meta(173, 'link'.$i, true ); ?>" target="_blank">
									<img src="<?php echo get_post_meta(173, 'banner'.$i, true ); ?>" alt="<?php echo get_post_meta(173, 'name'.$i, true ); ?>"></a>
								</div>
								<div class="icon mobile">
									<a href="<?php  $j=$i+9; echo get_post_meta(173, 'link'.$i, true ); ?>" target="_blank">
									<img src="<?php echo get_post_meta(173, 'banner'.$j, true ); ?>" alt="<?php echo get_post_meta(173, 'name'.$i, true ); ?>"></a>
								</div>
							<?php } ?>
						</div>
					</div>
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
				$('#site-footer .container .content>li>a').attr('href','javascript: void(0);');
				$('.elementor-32 .swiper-container img').hover(function(){
					var a =$(this).attr('src');
					$(this).attr('src',$(this).attr('src').replace(".jpg","_2.jpg"));
				},function(){
					var a =$(this).attr('src');
					$(this).attr('src',$(this).attr('src').replace("_2.jpg",".jpg"));
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
				//菜单栏始终浮动在顶部
				var navH = $("#site-header").offset().top;//获取要定位元素距离浏览器顶部的距离
				//滚动条事件
				$(window).scroll(function(){
						//获取滚动条的滑动距离
						var scroH = $(this).scrollTop();
						//滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定
						if(scroH>navH){
							$("#site-header").css({"position":"fixed","top":0,"left":0, "z-index":1000, "margin":"0 auto", "width":"100%"});
						}else if(scroH<=navH){
							$("#site-header").css({"position":"relative","margin":"0 auto"});
						}
						//console.log(scroH==navH);
					});
				});
		</script>
	</body>
</html>
