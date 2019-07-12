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
**Blog section**
=================================================== -->
<section class="error-page-bg">
    <div class="error-inner">
        <h1>OopS</h1>
        <p>Parece que você está procurando por algo que não existe.</p>
        <a href="<?php echo home_url() ?>" class="btn back-to-home">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>página inicial
        </a>
    </div>
</section>

<?php wp_footer(); ?>
</body>
</html>
