<ul class="clearfix">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <li>
            <div class="blog-item">
                <?php if (has_post_thumbnail()) : ?>
                    <figure class="blog-pic">
                        <!--Para imagens-->
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img class="img-fluid"
                                 src="<?php the_post_thumbnail_url('thumbnail'); ?>"
                                 alt="<?php the_title(); ?>">
                        </a>
                        <?php
                        $categories = get_the_category($post_ID);
                        if (isset($categories[0])) {
                            echo "<span class='post-meta'>{$categories[0]->name}</span>";
                        } ?>
                    </figure>
                <?php endif; ?>
                <h5 class="title">
                    <a href="<?php the_permalink(); ?>"
                       title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </h5>
                <div class="box">
                    <ul class="blog-info">
                        <li class="comment">
                            <?php comments_popup_link('0 Comentário', '1 Comentário', '% Comentários'); ?>
                        </li>
                    </ul>
                </div>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="know-more">Ver Mais</a>
            </div>
        </li>
    <?php endwhile; ?>
    <?php endif;
    wp_reset_postdata();
    wp_reset_query(); ?>
</ul>

<?php if (function_exists('wp_paginate')) wp_paginate(); ?>

<?php // get_template_part('template-parts/content/paginate', 'block') ?>
