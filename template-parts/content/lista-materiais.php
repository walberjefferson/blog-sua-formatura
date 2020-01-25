<ul class="row portfolio clearfix isotopeContainer">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <li class="col-6 col-md-4 isotopeSelector <?php the_field('tipo_de_arquivo') ?>">
            <div class="inner">
                <div class="overlay">
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_field('descricao') ?></p>
                    <?php if (get_field('arquivo')) : ?>
                        <a target="_blank" href="<?php the_field('arquivo') ?>">
                            <i class="fa fa-download"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (image_destaque()) : ?>
                    <figure>
                        <?php echo image_destaque(344, 236, ['class' => 'rounded img-fluid']); ?>
                    </figure>
                <?php else: ?>
                    <figure>
                        <img src="<?php echo get_template_directory_uri() ?>/images/material-download.png"
                             class="rounded img-fluid">
                    </figure>
                <?php endif; ?>
            </div>
        </li>
    <?php endwhile; ?>
    <?php endif;
    wp_reset_postdata();
    wp_reset_query(); ?>
</ul>

<?php if (function_exists('wp_paginate')) wp_paginate(); ?>

