<?php
require_once '../.config.php';

if ( file_exists( '../' . $dyn_dns_txt ) ) {
		$dynip = file_get_contents( '../' . $dyn_dns_txt );
		$url   = 'http://' . $dynip . ':666';
		header( "Location: $url" );
}
