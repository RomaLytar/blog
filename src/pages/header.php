<!DOCTYPE html>
<html lang="<?php echo(pll_current_language()); ?>" xmlns:og="http://ogp.me/ns#">
<head>
    <title><?php bloginfo('name'); wp_title(); ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php get_template_part('includes/head/head'); ?>
    <?php wp_head(); ?>
</head>
<body>
<?php get_template_part('includes/header/header'); ?>
