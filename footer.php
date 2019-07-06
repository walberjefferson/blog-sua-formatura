<!-- ==============================================
**Footer opt1**
=================================================== -->
<!--<footer class="footer landing-footer">-->
<!--    <div class="container clearfix">-->
<!--        <div class="right">-->
<!--            <ul class="social">-->
<!--                <li><a href="https://www.facebook.com/suaformaturaoficial" target="_blank"><i class="fa fa-facebook"-->
<!--                                                                                              aria-hidden="true"></i></a>-->
<!--                </li>-->
<!--                <li><a href="https://instagram.com/suaformatura?utm_source=ig_profile_share&amp;igshid=1evgevxgc1v4t"-->
<!--                       target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->
<!--                <li><a href="https://www.youtube.com/channel/UCepPyxYHlsW2zE4gxGXo5nA" target="_blank"><i-->
<!--                                class="fa fa-youtube" aria-hidden="true"></i></a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--</footer>-->

<footer class="footer grey-bg">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-flex">
                    <div class="align-self-center">
                        <?php the_logo_site(); ?>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <div class="align-self-center">
                        Copyright &copy; <?= date("Y") ?> <?php bloginfo('name') ?>. Todos os Direitos Reservados.
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <div class="float-right align-self-center">
                        <ul class="connect-us">
                            <li>
                                <a href="https://www.facebook.com/suaformaturaoficial" target="_blank">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/channel/UCepPyxYHlsW2zE4gxGXo5nA" target="_blank">
                                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://instagram.com/suaformatura" target="_blank">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to top -->
<a href="#" class="scroll-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>

<?php wp_footer(); ?>
</body>
</html>