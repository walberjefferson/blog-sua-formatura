<?php get_header(); ?>

<!-- ==============================================
**Inner Banner**
=================================================== -->
<section class="inner-banner">
    <div class="container">
        <div class="contents">
            <h1>Blog</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                <span>Lorem Ipsum has been the industry's standard dummy text ever since</span>
            </p>
        </div>
    </div>
</section>

<!-- ==============================================
**Blog section**
=================================================== -->
<section class="blog-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9">
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                    <div class="blog-content blog-detailed">
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="blog-pic">
                                <!--Para imagens-->
                                <img class="img-fluid" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                            </figure>
                        <?php endif; ?>
<!--                        <figure class="blog-pic">-->
<!--                            <img class="img-fluid" src="images/blog-details-pic-1.jpg" alt="">-->
<!--                        </figure>-->

                        <p class="time">
                            <span class="dia"><?php the_time('j'); ?></span> de <span
                                    class="mes"><?php the_time('F'); ?></span> de
                            <span class="ano"><?php the_time('Y'); ?></span>
                        </p>
                        <h5><?php the_title(); ?></h5>
                        <div class="box">
                            <ul class="blog-info">
                                <li class="comment"><?php comments_popup_link('0 Comentário', '1 Comentário', '% Comentários'); ?></li>
                            </ul>
                        </div>

                        <?php the_content(); ?>

                        <?php comments_template(); ?>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <?php get_sidebar(); ?>

        </div>
    </div>
</section>

<?php // get_template_part('template-parts/content/main', 'newsletter') ?>

<?php get_footer(); ?>
