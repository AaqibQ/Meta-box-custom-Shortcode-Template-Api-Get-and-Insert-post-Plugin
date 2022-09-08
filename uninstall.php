<?php 

defined('ABSPATH') || die('NICE TRY');

global $wpdb;
$sql_drop = "DROP TABLE IF EXISTS `{$wpdb->prefix}likesdislikes`;";
$wpdb->query($sql_drop);