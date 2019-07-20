<?php get_header(); ?>

<!-- ==============================================
**Inner Banner**
=================================================== -->
<section class="inner-banner">
    <div class="container">
        <div class="contents">
            <h1><?php bloginfo('title') ?></h1>
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
                                <img class="img-fluid" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                            </figure>
                        <?php endif; ?>
                        <h5><?php the_title(); ?></h5>
<!--                        <div class="box">-->
<!--                            <ul class="blog-info">-->
<!--                                <li class="comment">--><?php //comments_popup_link('Nenhum Comentário', '1 Comentário', '% Comentários'); ?><!--</li>-->
<!--                            </ul>-->
<!--                        </div>-->
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
