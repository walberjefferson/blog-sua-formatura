<?php get_header(); ?>

<!-- ==============================================
**Inner Banner**
=================================================== -->
<section class="inner-banner">
    <div class="container">
        <div class="contents">
            <h1><?php post_type_archive_title() ?></h1>
        </div>
    </div>
</section>

<!-- ==============================================
**Portfolio**
=================================================== -->
<section class="portfolio-outer padding-lg">

    <!-- Start portfolio filter -->
    <div class="container text-center">
        <div class="isotopeFilters">
            <ul class="portfolio-filter clearfix">
                <li class="active"><a href="#" data-filter="*">Todos</a></li>
                <li><a href="#" data-filter=".ebook">E-book</a></li>
                <li><a href="#" data-filter=".planilha">Planilhas</a></li>
                <li><a href="#" data-filter=".conteudo">Outros</a></li>
            </ul>
        </div>
        <!-- end portfolio filter -->

        <?php get_template_part('template-parts/content/lista', 'materiais') ?>
    </div>
</section>

<?php get_footer(); ?>
