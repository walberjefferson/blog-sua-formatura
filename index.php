<?php get_header(); ?>

<!-- ==============================================
**Inner Banner**
=================================================== -->
<section class="inner-banner">
    <div class="container">
        <div class="contents">
            <h1>Blog</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <span>Lorem Ipsum has been the industry's standard dummy text ever since</span>
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
            <ul class="clearfix">
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                    <li>
                        <div class="blog-item">
                            <figure class="blog-pic">
                                <img class="img-fluid" src="<?= get_template_directory_uri(); ?>/demo/images/blog-pic-1.jpg" alt="">
                                <?php $id_da_categoria = get_cat_id('blog'); $link_da_categoria = get_category_link($id_da_categoria); ?>
                            </figure>
                            <!--                            <p class="time">Dezembro 30, <span>2019</span></p>-->
                            <h5 style="font-weight: 500; font-size: 22px!important; line-height: 1.2em!important;">
                                <a href="#"><?php the_title(); ?></a>
                            </h5>
                            <div class="box">
                                <ul class="blog-info">
                                    <li class="comment">
                                        <?php comments_popup_link('0 Comentário', '1 Comentário', '% Comentários'); ?>
                                    </li>
                                </ul>
                            </div>
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="text-uppercase font-weight-bold">
                                Ler mais <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </li>
                <?php endwhile; else: ?>
                <?php endif; ?>

                <?php for ($i = 0; $i < 1; $i++): ?>
                    <li>
                        <div class="blog-item">
                            <figure class="blog-pic">
                                <img class="img-fluid"
                                     src="<?= get_template_directory_uri(); ?>/demo/images/blog-pic-1.jpg" alt="">
                            </figure>
                            <!--                            <p class="time">Dezembro 30, <span>2019</span></p>-->
                            <h5 style="font-weight: 500; font-size: 22px!important; line-height: 1.2em!important;">
                                <a href="#">Lorem Ipsum is simply dummy text of theprinting...</a>
                            </h5>
                            <!--                            <div class="box">-->
                            <!--                                <ul class="blog-info">-->
                            <!--                                    <li class="comment">5623 <a href="#">Comments</a></li>-->
                            <!--                                    <li class="like">5623 <a href="#">Likes</a></li>-->
                            <!--                                </ul>-->
                            <!--                            </div>-->
                            <p class="text-justify" style="font-size: 0.8rem; line-height: 1.2rem;">Lorem Ipsum is
                                simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make Lorem.</p>
                            <!--                            <ul class="blog-tag">-->
                            <!--                                <li><a href="#">Email Templaes</a></li>-->
                            <!--                                <li><a href="#">Html Editor</a></li>-->
                            <!--                            </ul>-->
                            <a href="#" class="text-uppercase font-weight-bold">Ler mais <i
                                        class="fa fa-arrow-right"></i></a>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>

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


<!-- ==============================================
**Signup Section**
=================================================== -->
<section class="signup-outer gradient-bg padding-lg">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <span class="et_pb_image_wrap">
                    <img src="https://blog.doity.com.br/wp-content/uploads/2018/06/carta.png" width="100%">
                </span>
            </div>

            <div class="col-8">
                <div>
                    <h2 style="font-size: 52px; color: #fff;" class="text-left font-weight-normal">Newsletter</h2>
                    <div class="textwidget">
                        <p style="color: #fff; font-size: 18px; padding-top: 30px; padding-bottom: 40px;"
                           class="text-left font-weight-light">
                            Entre para a nossa lista exclusiva e aprenda com os melhores conteúdos
                        </p>
                    </div>
                </div>
                <div>
                    <div class="textwidget">
                        <div role="form" class="wpcf7" id="wpcf7-f14604-o2" lang="pt-BR" dir="ltr">
                            <div class="screen-reader-response"></div>
                            <!--                            <form method="post">-->
                            <!--                                <p>-->
                            <!--                                    <span class="wpcf7-form-control-wrap email">-->
                            <!--                                        <input type="email" name="email" value="" size="40" placeholder="Digite seu melhor e-mail">-->
                            <!--                                    </span>-->
                            <!--                                    <input type="submit" value="Assinar agora">-->
                            <!--                                </p>-->
                            <!--                            </form>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-none">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <ul class="clearfix" style="padding-bottom: 0 !important;">
                    <li><span class="icon-men"></span>
                        <h4>Signup for an <span>Account</span></h4>
                    </li>
                    <li><span class="icon-chat"></span>
                        <h4>Discuss with <span>our team</span></h4>
                    </li>
                    <li><span class="icon-lap"></span>
                        <h4>Receive a <span>good support</span></h4>
                    </li>
                </ul>

                <!--                <div class="signup-form">-->
                <!--                    <form action="#" method="get">-->
                <!--                        <div class="email">-->
                <!--                            <input name="emails" type="text" placeholder="email">-->
                <!--                        </div>-->
                <!--                        <div class="password">-->
                <!--                            <input name="passwords" type="password" placeholder="password">-->
                <!--                        </div>-->
                <!--                        <button class="signup-btn">Sign up Now</button>-->
                <!--                    </form>-->
                <!--                </div>-->
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
