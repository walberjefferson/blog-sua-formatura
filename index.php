<?php get_header(); ?>

<?php get_template_part('template-parts/content/lista', 'carrosel') ?>

<section class="advices-outer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <form action="<?php echo get_option('home'); ?>" method="get" class="search-outer d-flex my-5">
                    <input name="s" type="text" placeholder="O que você procura?">
                    <button class="go-btn"><span class="icon-search"></span></button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ==============================================
**Blog section**
=================================================== -->
<section class="blog-section pt-0">
    <div class="container">
        <div class="blog-content masonry-blog grid">
            <?php get_template_part('template-parts/content/grid', 'itens') ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
