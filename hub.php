<?php
require_once '.config.php';

$pwortcontrol = $_GET['password'];
$ip           = $_GET['ip'];
$fw           = $_GET['fw'];
if ( file_exists( $dyn_dns_txt ) ) {
	if ( $pwortcontrol == $dyn_dns_password ) {
		file_put_contents( $dyn_dns_txt, $ip );
	} else {
		$dynip = file_get_contents( $dyn_dns_txt );
		if ( $fw == 1 ) {
			$url = 'https://' . $dynip;
		} else {
			$url = 'http://' . $dynip . '' . $dyn_dns_port;
		}
		header( "Location: $url" );
	}
}
