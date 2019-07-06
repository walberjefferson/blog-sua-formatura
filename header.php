<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>
<body>
<!-- ==============================================
**Preloader**
=================================================== -->
<div id="loader">
    <div id="element">
        <div class="circ-one"></div>
        <div class="circ-two"></div>
    </div>
</div>

<!-- ==============================================
**Header**
=================================================== -->
<header class="opt2">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <?php the_logo_site('', 'navbar-brand'); ?>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_sua_formatura"
                    aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php if (has_nav_menu('menu')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu',
                    'depth' => 2, // 1 = no dropdowns, 2 = with dropdowns.
                    'container' => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'nav_sua_formatura',
                    'menu_class' => 'navbar-nav mr-auto',
                    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                    'walker' => new WP_Bootstrap_Navwalker(),
                ));
                ?>
            <?php endif; ?>

            <?php if (has_nav_menu('menu_top_right')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu_top_right',
                    'container' => false,
                    'menu_class' => 'navbar-right d-flex',
                ));
                ?>
            <?php endif; ?>


        </div>
    </nav>
    <!-- End Navigation -->
</header>