<?php get_header(); ?>

<!-- ==============================================
**Inner Banner**
=================================================== -->
<section class="inner-banner">
    <div class="container">
        <div class="contents">
            <h1>Resultado da Busca</h1>
            <h2>Você fez uma busca por: <?php echo get_search_query(); ?></h2>
        </div>
    </div>
</section>

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

<?php // get_template_part('template-parts/content/main', 'newsletter') ?>

<?php get_footer(); ?>
