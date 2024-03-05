<?php
/**
 * Controller for the DYN DNS "Service"
 * 
 * @author dennisstinauer<dennis@stinauer.net>
 */

 require_once '../../.config.php';
 require_once 'sites/abstract-class-subdomain-handler.php';
 require_once 'sites/class-interface-nonagon-dev.php';

$interface_nonagon_dev = Interface_Nonagon_Dev::factory('123', '123');
if ( false !== $interface_nonagon_dev ){
   echo $interface_nonagon_dev; 
}
$interface_nonagon_dev->update_records();