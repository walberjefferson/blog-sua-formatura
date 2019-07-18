<?php
$stickies = get_option('sticky_posts');
$args = [
    'post__in' => $stickies,
    'posts_per_page' => 2,
    'ignore_sticky_posts' => 1,
];
$query_sticks = new WP_Query($args);
?>
<?php if ($query_sticks->have_posts()): ?>
    <section class="components component-carousel">
        <ul class="owl-carousel">
            <?php while ($query_sticks->have_posts()) : $query_sticks->the_post(); ?>
                <?php if (image_destaque()) : ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?= image_destaque(1350, 460, ['class' => 'img-fluid d-none d-md-block']); ?>
                            <?= image_destaque(800, 600, ['class' => 'img-fluid d-block d-md-none']); ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endwhile; ?>

        </ul>
    </section>
<?php endif; ?>