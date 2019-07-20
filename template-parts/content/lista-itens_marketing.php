<ul class="row marketing-list">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <li class="col-md-4">
            <div class="inner">
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
                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="know-more">Ver Mais</a>
            </div>
        </li>
    <?php endwhile; ?>
    <?php endif; ?>
</ul>

