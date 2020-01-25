<?php get_header(); ?>

<!-- ==============================================
**Inner Banner**
=================================================== -->
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <?php if (get_field('imagem_titulo')) : ?>
        <section class="components component-carousel">
            <?= _image_destaque_field('imagem_titulo', 'img_slide', ['class' => 'img-fluid d-none d-md-block']); ?>
            <?= _image_destaque_field('imagem_titulo', 'img_slide_responsive', ['class' => 'img-fluid d-block d-md-none']); ?>
            <?php // image_destaque_field('imagem_titulo', 1350, 350, ['class' => 'img-fluid w-100 d-none d-md-block']); ?>
            <?php // image_destaque_field('imagem_titulo', 800, 400, ['class' => 'img-fluid w-100 d-block d-md-none']); ?>
        </section>
    <?php elseif (has_post_thumbnail()) : ?>
        <section class="components component-carousel">
            <?= _image_destaque('img_slide', ['class' => 'img-fluid d-none d-md-block']); ?>
            <?= _image_destaque('img_titulo_responsive', ['class' => 'img-fluid d-block d-md-none']); ?>
            <?php // image_destaque(1350, 350, ['class' => 'img-fluid w-100 d-none d-md-block']); ?>
            <?php // image_destaque(800, 400, ['class' => 'img-fluid w-100 d-block d-md-none']); ?>
        </section>
    <?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>

<!-- ==============================================
**Blog section**
=================================================== -->
<section class="blog-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                    <div class="blog-content blog-detailed">
                        <?php $ocultar = get_field('ocultar_imagem') ?>
                        <?php if (has_post_thumbnail() && !$ocultar) : ?>
                            <figure class="blog-pic">
                                <!--Para imagens-->
                                <img class="img-fluid" src="<?php the_post_thumbnail_url('medium'); ?>"
                                     alt="<?php the_title(); ?>">
                            </figure>
                        <?php endif; ?>

                        <p class="text-center h6 text-uppercase">
                            <span class="badge badge-secondary p-2"><?= categoriaNome(); ?></span>
                        </p>
                        <h5 class="text-center font-weight-bold"><?php the_title(); ?></h5>
                        <p class="text-center">Escrito por: <strong><?php the_author(); ?></strong></p>
                        <div class="box">
                            <ul class="blog-info">
                                <li class="comment"><?php comments_popup_link('0 Comentário', '1 Comentário', '% Comentários'); ?></li>
                            </ul>
                        </div>

                        <?php the_content(); ?>

                        <div class="autor-artigo">
                            <?php echo get_avatar(get_the_author_meta('ID'), 96, '', get_the_author_meta('display_name'), ['class' => 'mx-auto']); ?>
                            <h6 class="mt-3 mb-2 font-weight-bold"><?php the_author_meta('display_name'); ?></h6>
                            <p><?php the_author_meta('description'); ?></p>
                        </div>


                        <?php comments_template(); ?>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
