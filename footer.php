<!-- ==============================================
**Footer opt1**
=================================================== -->

<footer class="footer grey-bg">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-flex justify-content-sm-center">
                    <div class="align-self-center m-auto">
                        <?php the_logo_site(); ?>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center mt-3 mt-md-0">
                    <div class="align-self-center text-center">
                        Copyright &copy; <?= date("Y") ?> <?php bloginfo('name') ?>. Todos os Direitos Reservados.
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-md-end justify-content-center">
                    <div class="float-md-right float-none align-self-center">
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