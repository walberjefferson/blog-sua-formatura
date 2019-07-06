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
        <div class="blog-content masonry-blog grid">
            <?php get_template_part('template-parts/content/lista', 'itens') ?>

            <!--            <div class="paging-block">-->
            <!--                <ul>-->
            <!--                    <li><a href="#" class="prev"><span class="icon-left-arrow"></span></a></li>-->
            <!--                    <li class="active"><a href="#">1</a></li>-->
            <!--                    <li><a href="#">2</a></li>-->
            <!--                    <li><a href="#">3</a></li>-->
            <!--                    <li><a href="#">4</a></li>-->
            <!--                    <li><a href="#" class="dots"><span class="icon-paging-dots"></span></a></li>-->
            <!--                    <li><a href="#">43</a></li>-->
            <!--                    <li><a href="#" class="next"><span class="icon-right-arrow"></span></a></li>-->
            <!--                </ul>-->
            <!--            </div>-->
        </div>
    </div>
</section>

<!--<section class="latest-stories padding-lg">-->
<!--    <div class="container">-->
<!--        --><?php //get_template_part('template-parts/content/lista', 'cards') ?>
<!--    </div>-->
<!--</section>-->


<?php // get_template_part('template-parts/content/main', 'newsletter') ?>

<?php get_footer(); ?>
