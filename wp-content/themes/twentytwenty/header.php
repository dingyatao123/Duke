<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
$blog_id = get_current_blog_id();
?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<!--网页标题左侧显示-->
		<link rel="icon" href="<?php bloginfo('template_directory'); ?>/assets/images/icon.ico" type="image/x-icon">
		<!--收藏夹显示图标-->
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/images/icon.ico" type="image/x-icon">
		<?php wp_head(); ?>
		<link href="<?php bloginfo('template_directory'); ?>/assets/css/swiper.min.css" rel="stylesheet">
		<link href="<?php bloginfo('template_directory'); ?>/assets/css/style.css" rel="stylesheet">
		<script src="<?php bloginfo('template_directory'); ?>/assets/js/jquery-3.5.1.min.js" type='text/javascript'></script>
		<script src="<?php bloginfo('template_directory'); ?>/assets/js/jquery-migrate-3.0.1.min.js" type='text/javascript'></script>
		<script src="<?php bloginfo('template_directory'); ?>/assets/js/swiper.min.js" type='text/javascript'></script>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-TWCR3S9');</script>
		<!-- End Google Tag Manager -->
	</head>

	<body <?php body_class(); ?> id="dukekunshan<?php echo $blog_id; ?>">
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TWCR3S9"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<?php
		wp_body_open();
		?>

		<header id="site-header" class="header-footer-group" role="banner">
			<div class="header-top">
				<div class="cont">
					<div class="lf">
						<div>
							<img class="earch" src="<?php bloginfo('template_directory'); ?>/assets/images/1.png" />
						</div> 
						<?php if($blog_id==3){echo 'English – International Students';}else{echo '中文 – 中国学生';} ?> 
						<div>
							<img class="sq" src="<?php bloginfo('template_directory'); ?>/assets/images/2.png" />
							<ul>
								<li><a href="/">中文 – 中国学生</a></li>
								<li><a href="/en">English – International Students</a></li>
							</ul>
						</div>
					</div>
					<div class="rt">
						<ul class="primary-menu reset-list-style">
							<?php
							if ( has_nav_menu( 'social' ) ) {
								wp_nav_menu(
									array(
										'container'  => '',
										'items_wrap' => '%3$s',
										'theme_location' => 'social',
									)
								);

							}
							?>
						</ul>
						<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
							<div><img class="earch" src="<?php bloginfo('template_directory'); ?>/assets/images/3.png" /></div>
							<input class="searchInput" type="text" placeholder="<?php if($blog_id==3){echo 'Search';}else{echo '搜索';} ?>" name="s" id="s"/>
						</form>

						<script type="text/javascript">
							$(document).ready(function(){
								// 当鼠标聚焦在搜索框
								$('#s').focus(
									function() {
										if($(this).val() == '搜索') {
											$(this).val('').css({color:"#454545"});
										}
									}
								// 当鼠标在搜索框失去焦点
								).blur(
									function(){
										if($(this).val() == '') {
											$(this).val('搜索').css({color:"#333333"});
										}
									}
								);
							});
						</script>
					</div>
				</div>
			</div><!-- .header-top -->
			<div class="header-inner section-inner">

				<div class="header-titles-wrapper">

					<div class="header-titles">
												
						<?php
							// Site title or logo.
							twentytwenty_site_logo();
												
							// Site description.
							twentytwenty_site_description();
						?>
					
					</div><!-- .header-titles -->
						
					<button class="toggle lan-toggle mobile-lan-toggle">
						<span class="toggle-inner lanicon">
							<img style="display: inline-block;" class="gb2" src="<?php bloginfo('template_directory'); ?>/assets/images/<?php if($blog_id==3){echo 17;}else{echo 12;} ?>.png" width="20" title="">
						</span>
					</button><!-- .nav-toggle -->
					<div class="lan">
						<ul>
							<li><a href="/">中文 – 中国学生</a></li>
							<li><a href="/en">English – International Students</a></li>
						</ul>
					</div>
					<?php

					// Check whether the header search is activated in the customizer.
					$enable_header_search = get_theme_mod( 'enable_header_search', true );

					if ( true === $enable_header_search ) {

						?>

						<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
							<span class="toggle-inner">
							<img style="display: inline-block;" class="gb2" src="<?php bloginfo('template_directory'); ?>/assets/images/11.png" width="20" title="">
							</span>
						</button><!-- .search-toggle -->

					<?php } ?>

					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<img style="display: inline-block;" class="gb2" src="<?php bloginfo('template_directory'); ?>/assets/images/10.png" width="20" title="">
						</span>
					</button><!-- .nav-toggle -->

				</div><!-- .header-titles-wrapper -->

				<div class="header-navigation-wrapper">

					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>

							<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'twentytwenty' ); ?>" role="navigation">

								<ul class="primary-menu reset-list-style">

								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);

								}
								?>

								</ul>

							</nav><!-- .primary-menu-wrapper -->

						<?php
					}
					?>

				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->

			<?php
			// Output the search modal (if it is activated in the customizer).
			if ( true === $enable_header_search ) {
				get_template_part( 'template-parts/modal-search' );
			}
			?>

		</header><!-- #site-header -->
		<?php if($blog_id==3){ ?> 
			<div class="enicon">
				<ul>
					<li>
						<a href="/en">
							<img src="https://duke.s3.cn-northwest-1.amazonaws.com.cn/wp-content/uploads/sites/3/2020/11/10134626/202.png">
							<div>
								<img src="https://duke.s3.cn-northwest-1.amazonaws.com.cn/wp-content/uploads/sites/3/2020/11/10134648/206.png">
							</div>
						</a>
					</li>
					<li>
						<a href="https://apply.dukekunshan.edu.cn/portal/iem_events" target="_blank">
							<img src="https://duke.s3.cn-northwest-1.amazonaws.com.cn/wp-content/uploads/sites/3/2020/11/10134630/203.png">
							<div>
								<img src="https://duke.s3.cn-northwest-1.amazonaws.com.cn/wp-content/uploads/sites/3/2020/11/10134827/207.png">
								<p>Register for a virtual visit</p>
							</div>
						</a>
					</li>
					<li>
						<a href="https://apply.dukekunshan.edu.cn/portal/iem_events" target="_blank">
							<img src="https://duke.s3.cn-northwest-1.amazonaws.com.cn/wp-content/uploads/sites/3/2020/11/10134634/204.png">
							<div>
								<img src="https://duke.s3.cn-northwest-1.amazonaws.com.cn/wp-content/uploads/sites/3/2020/11/10134655/208.png">
								<p>Register for an info session</p>
							</div>
						</a>
					</li>
					<li>
						<a href="https://apply.dukekunshan.edu.cn/register/ConnectWithUs" target="_blank">
							<img src="https://duke.s3.cn-northwest-1.amazonaws.com.cn/wp-content/uploads/sites/3/2020/11/10153207/210.png">
							<div>
								<img src="https://duke.s3.cn-northwest-1.amazonaws.com.cn/wp-content/uploads/sites/3/2020/11/10153211/211.png">
								<p>Join our mailing list</p>
							</div>
						</a>
					</li>
				</ul>
			</div>
		<?php } ?> 
		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
