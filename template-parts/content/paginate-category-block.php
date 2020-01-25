<div class="paging-block">
    <div class="row">
        <div class="col-4">
            <?php if (get_previous_posts_link()) : ?>
                <a href="<?= get_previous_posts_page_link(); ?>" class="btn large border">Mais Recentes</a>
            <?php endif; ?>
        </div>
        <div class="offset-4 col-4">
            <?php if (get_next_posts_link()) : ?>
                <a href="<?= get_next_posts_page_link(); ?>" class="btn large border">Mais Antigos</a>
            <?php endif; ?>
        </div>
    </div>
</div>