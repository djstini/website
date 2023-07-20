<?php
require_once '../.config.php';

$pwortcontrol = $_GET['pass'];
$ip           = $_GET['meineip'];
$fw           = $_GET['FW'];
if ( file_exists( $dyn_dns_txt ) ) {
	if ( $pwortcontrol == $dyn_dns_password ) {
		$a = fopen( "$dyn_dns_txt", 'w' );
		fwrite( $a, $ip );
		fclose( $a );
	} else {
		$a     = fopen( "$dyn_dns_txt", 'r+' );
		$dynip = fread( $a, filesize( $dyn_dns_txt ) );
		fclose( $a );
		if ( $fw == 1 ) {
			$url = 'https://' . $dynip;
		} else {
			$url = 'http://' . $dynip . '' . $dyn_dns_port;
		}
		header( "Location: $url" );
	}
}
