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
            <?php get_template_part('template-parts/content/lista', 'itens') ?>
        </div>
    </div>
</section>

<!--<section class="content-marketing padding-lg">-->
<!--    <div class="container">-->
<!--        --><?php // get_template_part('template-parts/content/lista', 'itens_marketing') ?>
<!--    </div>-->
<!--</section>-->

<?php // get_template_part('template-parts/content/main', 'newsletter') ?>

<?php get_footer(); ?>
