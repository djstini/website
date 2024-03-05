<?php
/**
 * @author dennisstinauer<dennis@stinauer.net>
 */

/**
 * Class to handle the registration of interface.nonagon.dev subdomain.
 */
class Interface_Nonagon_Dev extends Subdomain_Handler{
    public static function factory($value_ipv4, $value_ipv6){
        if(!defined(DNS_AUTH_API_TOKEN) || !defined(DNS_ZONE_ID_INTERFACE_NONAGON_DEV)){
            return false;
        }
        $auth_api_token = DNS_AUTH_API_TOKEN;
        $zone_id = DNS_ZONE_ID_INTERFACE_NONAGON_DEV;
        return new Interface_Nonagon_Dev($auth_api_token, $zone_id, $value_ipv4, $value_ipv6);
    }
}