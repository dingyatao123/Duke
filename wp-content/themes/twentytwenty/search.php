<?php
get_header();
$blog_id = get_current_blog_id();
?>
	<div id="primary" class="content-area container search center">
		<main id="main" class="site-main">
            <header class="page-header">
				<h1 class="page-title"><?php if($blog_id==1){
										echo '搜索结果';
									}else{
										echo 'Search Results';
									}  ?></h1>
				<!-- <div class="page-description"><?php echo get_search_query(); ?></div> -->
			</header><!-- .page-header -->
            <div class="no-search-results-form section-inner thin">
                <?php
                get_search_form(
                    array(
                        'label' => __( 'search again', 'twentytwenty' ),
                    )
                );
                ?>
            </div><!-- .no-search-results --> 
            <?php
                global $wp_query;
                if($blog_id==1){
                    echo '<p class="count">'.get_search_query() . ' 的搜索结果 "'.$wp_query->found_posts.'"</p>';
                }else{
                    echo '<p class="count">'.$wp_query->found_posts . ' Results for "'.get_search_query().'"</p>';
                }
            ?>
            <div class="O-Search-SearchResultGroup__results">
			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				//get_template_part( 'template-parts/content/content', 'excerpt' );
                ?>
                <div class="O-Search-SearchResultGroup__item" data-ng-repeat="result in $ctrl.results">
                    <m-search-result-item-dynamic data-page="result.page" data-title="result.title" data-text="result.snippet" data-url="result.url">
                        <article class="row">
                            <div class="col-xs-12">
                                <a href="<?php echo the_permalink() ?>">
                                    <div class="M-Search-SearchResultItem">
                                        <div class="M-Search-SearchResultItem__wrapper">
                                            <div class="M-Search-SearchResultItem__page" data-ng-bind="$ctrl.page"></div>
                                            <div class="M-Search-SearchResultItem__title" data-ng-bind-html="$ctrl.prepareHtml($ctrl.title)">
                                                <?php the_title(); ?>
                                            </div>
                                            <!---->
                                            <div class="M-Search-SearchResultItem__text" data-ng-bind-html="$ctrl.prepareHtml($ctrl.text)" data-ng-if="$ctrl.text">
                                                <?php the_excerpt(); ?>
                                            </div>
                                            <!---->
                                        </div>
                                    </div></a>
                            </div>
                        </article>
                    </m-search-result-item-dynamic>
                </div>
                <?php
                // End the loop.
                endwhile;
                the_posts_navigation();
		        ?>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
?>

