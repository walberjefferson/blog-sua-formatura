<?php get_header(); ?>

<!-- ==============================================
**Inner Banner**
=================================================== -->
<section class="inner-banner">
    <div class="container">
        <div class="contents">
            <h1>Blog</h1>
            <h2><?php single_cat_title(); ?></h2>
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
                <div class="blog-content masonry-blog">
                    <?php get_template_part('template-parts/content/lista', 'itens') ?>
                </div>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/content/main', 'newsletter') ?>

<?php get_footer(); ?>
