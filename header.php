<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

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
<header>
    <!-- Start Header top Bar -->
    <!--    <div class="header-top">-->
    <!--        <div class="container clearfix">-->
    <!--            <div class="lang-wrapper">-->
    <!--                <div class="select-lang">-->
    <!--                    <select class="currency_select">-->
    <!--                        <option value="usd">USD</option>-->
    <!--                        <option value="aud">AUD</option>-->
    <!--                        <option value="gbp">GBP</option>-->
    <!--                    </select>-->
    <!--                </div>-->
    <!--                <div class="select-lang2">-->
    <!--                    <select class="custom_select">-->
    <!--                        <option value="en">English</option>-->
    <!--                        <option value="fr">French</option>-->
    <!--                        <option value="de">German</option>-->
    <!--                    </select>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="right-block clearfix">-->
    <!--                <ul class="top-nav hidden-xs">-->
    <!--                    <li><a href="about.html">About</a></li>-->
    <!--                    <li><a href="support.html">Support</a></li>-->
    <!--                    <li><a href="career.html">Career</a></li>-->
    <!--                    <li><a href="faq.html">FAQs</a></li>-->
    <!--                </ul>-->
    <!--                <ul class="follow-us hidden-xs">-->
    <!--                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>-->
    <!--                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
    <!--                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>-->
    <!--                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>-->
    <!--                    <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>-->
    <!--                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->
    <!--                </ul>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!-- End Header top Bar -->

    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="<?= get_home_url(); ?>">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $custom_logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                if (has_custom_logo()) {
                    echo '<img src="' . esc_url($custom_logo_url) . '" alt="' . get_bloginfo('name') . '" class="img-fluid">';
                } else {
                    echo '<h2>' . get_bloginfo('name') . '</h2>';
                }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= get_home_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown2" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">Banners</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown2">
                            <div class="inner">
                                <a class="dropdown-item" href="banner-solid.html">Banner Solid</a>
                                <a class="dropdown-item" href="banner-gradient.html">Banner Gradient</a>
                                <a class="dropdown-item" href="banner-animated-gradient.html">Banner Animated
                                    Gradient</a>
                                <a class="dropdown-item" href="banner-image.html">Banner Image</a>
                                <a class="dropdown-item" href="banner-video.html">Banner Video</a>
                                <a class="dropdown-item" href="banner-carousel.html">Banner Carousel</a>
                                <a class="dropdown-item" href="banner-typing.html">Banner Typing</a>
                                <a class="dropdown-item" href="banner-particles.html">Banner Particles</a>
                                <a class="dropdown-item" href="banner-parallax.html">Banner Parallax</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown3" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">Blocks</a>
                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown3">
                            <div class="inner">
                                <ul>
                                    <li><a class="dropdown-item" href="features-blocks.html">Features Blocks</a></li>
                                    <li><a class="dropdown-item" href="call-to-action.html">Call to Action</a></li>
                                    <li><a class="dropdown-item" href="header-blocks.html">Header Blocks</a></li>
                                    <li><a class="dropdown-item" href="marketing-blocks.html">Marketing Blocks</a></li>
                                </ul>
                                <ul>
                                    <li><a class="dropdown-item" href="pricing-blocks.html">Pricing Blocks</a></li>
                                    <li><a class="dropdown-item" href="team-blocks.html">Team Blocks</a></li>
                                    <li><a class="dropdown-item" href="testimonial-blocks.html">Testimonial Blocks</a>
                                    </li>
                                    <li><a class="dropdown-item" href="blog-blocks.html">Blog Blocks</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown4" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">Blog</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown4">
                            <div class="inner">
                                <a class="dropdown-item" href="blog-grid.html">Blog Grid</a>
                                <a class="dropdown-item" href="blog-grid-sidebar.html">Blog Grid Sidebar</a>
                                <a class="dropdown-item" href="blog-list.html">Blog List</a>
                                <a class="dropdown-item" href="blog-standard.html">Blog Standard</a>
                                <a class="dropdown-item" href="blog-single.html">Blog Single</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown5" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">pages</a>
                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown5">
                            <div class="inner">
                                <ul>
                                    <li><a class="dropdown-item" href="about.html">About</a></li>
                                    <li><a class="dropdown-item" href="features.html">Features</a></li>
                                    <li><a class="dropdown-item" href="how-it-works.html">How it Works</a></li>
                                    <li><a class="dropdown-item" href="pricing.html">Pricing</a></li>
                                    <li><a class="dropdown-item" href="portfolio.html">Portfolio</a></li>
                                    <li><a class="dropdown-item" href="career.html">Career 1</a></li>
                                    <li><a class="dropdown-item" href="career1.html">Career 2</a></li>
                                    <li><a class="dropdown-item" href="apply-job.html">Apply Job</a></li>
                                    <li><a class="dropdown-item" href="support.html">Support</a></li>
                                    <li><a class="dropdown-item" href="contact.html">Contact</a></li>
                                </ul>
                                <ul>
                                    <li><a class="dropdown-item" href="faq.html">Faq 1</a></li>
                                    <li><a class="dropdown-item" href="faq1.html">Faq 2</a></li>
                                    <li><a class="dropdown-item" href="login.html">Login</a></li>
                                    <li><a class="dropdown-item" href="register.html">Register</a></li>
                                    <li><a class="dropdown-item" href="privacy-policy.html">Privacy Policy</a></li>
                                    <li><a class="dropdown-item" href="404.html">404</a></li>
                                    <li><a class="dropdown-item" href="typography.html">Typography</a></li>
                                    <li><a class="dropdown-item" href="components.html">Components</a></li>
                                    <li><a class="dropdown-item" href="comingsoon.html">Comingsoon</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown6" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">Shop</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown6">
                            <div class="inner">
                                <a class="dropdown-item" href="shop-grid.html">Shop Grid</a>
                                <a class="dropdown-item" href="shop-grid-sidebar.html">Shop Grid Sidebar</a>
                                <a class="dropdown-item" href="shop-single.html">Shop Single</a>
                                <a class="dropdown-item" href="cart.html">Cart</a>
                                <a class="dropdown-item" href="checkout.html">Checkout</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-right d-flex">
                    <li><a href="register.html">Signup</a></li>
                    <li><a href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->
</header>