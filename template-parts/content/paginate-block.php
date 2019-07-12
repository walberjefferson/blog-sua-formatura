<div class="paging-block">
    <div class="row">
        <?php if (is_home()): ?>
        <div class="col-3">
            <?php else : ?>
            <div class="col-4">
                <?php endif; ?>
                <?php if (get_previous_posts_link()) : ?>
                    <a href="<?= get_previous_posts_page_link(); ?>" class="btn large border">Mais Recentes</a>
                <?php endif; ?>
            </div>

            <?php if (is_home()): ?>
            <div class="offset-6 col-3">
                <?php else : ?>
                <div class="offset-4 col-4">
                    <?php endif; ?>

                    <?php if (get_next_posts_link()) : ?>
                        <a href="<?= get_next_posts_page_link(); ?>" class="btn large border">Mais Antigos</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>