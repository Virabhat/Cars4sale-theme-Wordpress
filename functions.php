<?php
function cars4sale_enqueue_styles()
{
    wp_enqueue_style(
        'google-fonts-prompt',
        'https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style('main-style', get_stylesheet_uri());

    if (is_front_page()) {
        wp_enqueue_style(
            'front-page-style',
            get_template_directory_uri() . '/css/front-page.css',
            array('main-style'),
            '1.0'
        );
    }

    if (is_singular('car')) {
        wp_enqueue_style(
            'single-car-style',
            get_template_directory_uri() . '/css/single-car.css',
            array('main-style'),
            '1.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'cars4sale_enqueue_styles');