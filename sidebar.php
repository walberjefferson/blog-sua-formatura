<!-- ==============================================
            **Blog Sidebar**
            =================================================== -->
<aside class="col-md-4 col-lg-3">
    <div class="blog-sidebar">

        <!--Start Categories-->
        <div class="cmn-box">
            <h4>Categorias</h4>
            <ul>
                <?php
                $categorias = get_categories();
                foreach ($categorias as $categoria) : ?>
                    <li>
                        <a href="<?= get_category_link($categoria->term_id); ?>"><?= $categoria->name ?>
                            <span class="count"><?= $categoria->count; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--End Categories-->

    </div>
</aside>