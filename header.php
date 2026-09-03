<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="site-header">
        <div class="header-container">
            <div class="site-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <h2>🚗 Cars4Sale</h2>
                </a>
            </div>
            <nav class="site-nav">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <a href="#cars">Cars</a>
                <a href="#contact">Contact</a>
                <a href="about">About</a>
            </nav>
            <div class="header-contact">
                <a href="tel:+66810000000" class="phone-btn">📞 +66 81-XXX-XXXX</a>
            </div>
        </div>
    </header>