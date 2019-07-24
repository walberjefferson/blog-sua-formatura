<?php

function theme_option_page()
{
    ?>
    <div class="wrap">
        <h1>Opções do Tema</h1>
        <form method="post" action="options.php">
            <?php
            // display settings field on theme-option page
            settings_fields("theme-options-grp");
            // display all sections for theme-options page
            do_settings_sections("theme-options");
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function add_options_theme_wj()
{
    add_theme_page('Personalização do Tema', 'Opções do Tema', 'edit_theme_options', 'theme-options', 'theme_option_page');
}

add_action('admin_menu', 'add_options_theme_wj');

function display_test_twitter_element()
{
    ?>
    <input type="text" name="test_twitter_url" id="test_twitter_url"
           value="<?php echo get_option('test_twitter_url'); ?>"/>
    <?php
}

function input_qtd_home()
{
    echo sprintf('<input type="%s" name="%s" id="%s" value="%s" placeholder="%s" />', 'number', 'wj_qtd_home', 'wj_qtd_home', get_option('wj_qtd_home'), '3');
}

function input_qtd_category()
{
    echo sprintf('<input type="%s" name="%s" id="%s" value="%s" placeholder="%s"/>', 'number', 'wj_qtd_category', 'wj_qtd_category', get_option('wj_qtd_category'), '6');
}

function input_qtd_materiais()
{
    echo sprintf('<input type="%s" name="%s" id="%s" value="%s" placeholder="%s"/>', 'number', 'wj_qtd_materiais', 'wj_qtd_materiais', get_option('wj_qtd_materiais'), '9');
}

function input_qtd_busca()
{
    echo sprintf('<input type="%s" name="%s" id="%s" value="%s" placeholder="%s"/>', 'number', 'wj_qtd_busca', 'wj_qtd_busca', get_option('wj_qtd_busca'), '8');
}

function input_qtd_slide()
{
    echo sprintf('<input type="%s" name="%s" id="%s" value="%s" placeholder="%s"/>', 'number', 'wj_qtd_slide', 'wj_qtd_slide', get_option('wj_qtd_slide'), '2');
}

function config_theme_options()
{
    add_option('custom_options_theme_wj', 1); // add theme option to database
    add_settings_section('title_section', 'Configurações de quantidade de post por página', null, 'theme-options');

    add_settings_field('wj_qtd_slide', 'Quantidade de posts de Slide', 'input_qtd_slide', 'theme-options', 'title_section');
    add_settings_field('wj_qtd_home', 'Quantidade de posts Home', 'input_qtd_home', 'theme-options', 'title_section');
    add_settings_field('wj_qtd_category', 'Quantidade de posts por Categoria', 'input_qtd_category', 'theme-options', 'title_section');
    add_settings_field('wj_qtd_materiais', 'Quantidade de posts de Materiais', 'input_qtd_materiais', 'theme-options', 'title_section');
    add_settings_field('wj_qtd_busca', 'Quantidade de posts resultado da Busca', 'input_qtd_busca', 'theme-options', 'title_section');

    register_setting('theme-options-grp', 'wj_qtd_slide');
    register_setting('theme-options-grp', 'wj_qtd_home');
    register_setting('theme-options-grp', 'wj_qtd_category');
    register_setting('theme-options-grp', 'wj_qtd_materiais');
    register_setting('theme-options-grp', 'wj_qtd_busca');
}

add_action('admin_init', 'config_theme_options');
