<?php
/*
Template Name: Custom Page
 */
get_header(); ?>

    <div class="container">
        <div class="modal"></div>
		<?php
		$args = array(
			'post_type' => 'smartphones',
		);
		$smartphones = new WP_Query( $args );
		$max_pages   = $smartphones->max_num_pages;

		if ( $smartphones->have_posts() ): ?>
            <div class="smartphones" id="ajax-portfolio-container">

				<?php while ( $smartphones->have_posts() ): $smartphones->the_post(); ?>
                    <div class="project-block">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail() ?>
                            <p class="title"><?php the_title(); ?></p>
                        </a>
                        <p class="desc"><?php the_excerpt(); ?></p>
                        <p class="price"><?php echo get_post_meta( $post->ID, 'price', true ); ?> $</p>
                    </div>
				<?php endwhile; ?>

				<?php if ( $max_pages > 1 ): ?>
                    <div class="ajax-button">
                        <button id="load-more-events" href="#" class="btn btn-orange" data-page="2">Load More</button>
                    </div>
				<?php endif; ?>
            </div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
        <script type="text/html" id="project-block">
            <div class="project-block">
                <a data-link="permalink">
                    <img data-src="thumbnail" alt="">
                    <p class="title" data-content="title"></p>
                </a>
                <p class="desc" data-content="decsription"></p>
                <p class="price" data-content="price"></p>
            </div>
        </script>
        <script type="text/html" id="project-error">
            <div class="not-found">
                <p class="error" data-content="error"></p>
            </div>
        </script>
    </div>
<?php
get_sidebar();
get_footer();