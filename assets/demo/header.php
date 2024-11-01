<?php
/*
 * demo folder script is a standalone php, without wordpress's function
 * so, the wp-load.php have to be loaded here (follow internet suggestion)
 * and, re-use the wordpress theme header
 */
require_once('../wp-load.php'); 
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?> Demo</title> 
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<body> 