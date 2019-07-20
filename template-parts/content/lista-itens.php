<ul>
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <li>
            <p class="time">
                <span class="dia"><?php the_time('j'); ?></span> de <span
                        class="mes"><?php the_time('F'); ?></span> de
                <span class="ano"><?php the_time('Y'); ?></span>
            </p>
            <h5><?php the_title(); ?></h5>
            <div class="box">
                <ul class="blog-info">
                    <li class="comment">
                        <?php comments_popup_link('0 Comentário', '1 Comentário', '% Comentários'); ?>
                    </li>
                </ul>
            </div>
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
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>" class="know-more">Ver Mais</a>
        </li>
    <?php endwhile; ?>
    <?php endif;
    wp_reset_postdata();
    wp_reset_query(); ?>
</ul>

<?php if (function_exists('wp_paginate')) wp_paginate(); ?>
