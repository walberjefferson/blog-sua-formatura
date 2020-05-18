<?php get_header(); ?>

<!-- ==============================================
**Inner Banner**
=================================================== -->
<section class="inner-banner">
    <div class="container">
        <div class="contents">
            <h2>Blog</h2>
            <h1><?php single_cat_title(); ?></h1>
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
                    <?php get_template_part('template-parts/content/grid', 'itens') ?>
                </div>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
