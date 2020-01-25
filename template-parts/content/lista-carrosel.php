<?php
$stickies = get_option('sticky_posts');
$qtd_slide = (get_option('wj_qtd_slide')) ? get_option('wj_qtd_slide') : 2;
$args = [
    'post__in' => $stickies,
    'posts_per_page' => $qtd_slide,
    'ignore_sticky_posts' => 1,
];
$query_sticks = new WP_Query($args);
?>
<?php if ($query_sticks->have_posts() && count($stickies)): ?>
    <section class="components component-carousel">
        <ul class="owl-carousel">
            <?php while ($query_sticks->have_posts()) : $query_sticks->the_post(); ?>
                <?php if (image_destaque_field('imagem_slide')): ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?= _image_destaque_field('imagem_slide', 'img_slide', ['class' => 'img-fluid d-none d-md-block']); ?>
                            <?= _image_destaque_field('imagem_slide', 'img_slide_responsive', ['class' => 'img-fluid d-block d-md-none']); ?>
                            <?php //image_destaque_field('imagem_slide', 1350, 360, ['class' => 'img-fluid d-none d-md-block']); ?>
                            <?php //image_destaque_field('imagem_slide', 800, 380, ['class' => 'img-fluid d-block d-md-none']); ?>
                        </a>
                    </li>
                <?php elseif (image_destaque()) : ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?= _image_destaque('img_slide', ['class' => 'img-fluid d-none d-md-block']); ?>
                            <?= _image_destaque('img_slide_responsive', ['class' => 'img-fluid d-block d-md-none']); ?>
                            <?php // image_destaque(1350, 360, ['class' => 'img-fluid d-none d-md-block']); ?>
                            <?php // image_destaque(800, 380, ['class' => 'img-fluid d-block d-md-none']); ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
    </section>
<?php endif; ?>