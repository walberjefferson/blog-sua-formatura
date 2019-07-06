<?php if (have_posts()): ?>
    <div class="card-deck blog-blocks">
        <?php while (have_posts()) : the_post(); ?>
            <div class="card">
                <?php if (has_post_thumbnail()) : ?>
                    <figure class="blog-pic">
                        <!--Para imagens-->
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img class="img-fluid"
                                 src="<?php the_post_thumbnail_url('thumbnail'); ?>"
                                 alt="<?php the_title(); ?>">
                        </a>
                    </figure>
                <?php endif; ?>
                <div class="card-body">
                    <h3 class="title">
                        <a href="<?php the_permalink(); ?>"
                           title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <span class="date">10 Nov 2017</span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>