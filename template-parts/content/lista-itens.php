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
                        <span class="post-meta">Categoria</span>
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
                <a href="<?php the_permalink(); ?>" title="Ler Mais"
                   class="text-uppercase font-weight-bold">
                    Ler mais <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </li>
    <?php endwhile; ?>
    <?php endif; ?>
</ul>