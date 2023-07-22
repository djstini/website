<?php
require_once '../.config.php';
$uri = str_replace( '/tandoor', '', $_SERVER[ REQUEST_URI ] );

if ( file_exists( '../' . $dyn_dns_txt ) ) {
		$dynip = file_get_contents( '../' . $dyn_dns_txt );
		$url   = 'http://' . $dynip . ':666' . $uri;
		header( "Location: $url" );
}
