<?php
/**
 * Define Abstract Class here that will be used in the Subdomain Classes.
 * 
 * @author dennisstinauer<dennis@stinauer.net>
 */

/**
 * Class to handle the registration of interface.nonagon.dev subdomain.
 */
abstract class Subdomain_Handler{
    
    /**
     * The API TOKEN
     */
    private string $auth_api_token;

    /**
     * The Zone ID
     */
    private string $zone_id;

    /**
     * The Time to Live
     */
    private int $ttl = 600;

    /**
     * The DNS Record VALUE
     */
    private string $value_ipv4;
    
    /**
     * The DNS Record VALUE
     */
    private string $value_ipv6;

    public function __construct($auth_api_token, $zone_id, $value_ipv4, $value_ipv6){
        $this->auth_api_token = $auth_api_token;
        $this->zone_id = $zone_id;
        $this->$value_ipv4 = $value_ipv4;
        $this->$value_ipv6 = $value_ipv6;

        $records = $this->get_all_records();
    }

    public function update_records(){
        // $this->update_record('www', 'A', $this->value_ipv4);
        // $this->update_record('@', 'A', $this->value_ipv4);
        // $this->update_record('www', 'AAAA', $this->value_ipv6);
        // $this->update_record('@', 'AAAA', $this->value_ipv6);
    }

    private function update_record($record_id, $record_name, $record_type, $record_value){
        // get cURL resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, 'https://dns.hetzner.com/api/v1/records/' . $record_id);

        // set method
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

        // return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // set headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Auth-API-Token: ' . $this->auth_api_token,
        ]);

        // json body
        $json_array = [
        'value' => $record_value,
        'ttl' => $this->ttl,
        'type' => $record_type,
        'name' => $record_name,
        'zone_id' => $this->zone_id,
        ]; 
        $body = json_encode($json_array);

        // set body
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        // send the request and save response to $response
        $response = curl_exec($ch);

        // stop if fails
        if (!$response) {
        die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }

        echo 'HTTP Status Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL;
        echo 'Response Body: ' . $response . PHP_EOL;

        // close curl resource to free up system resources 
        curl_close($ch);

    }

    private function get_all_records(){
        // get cURL resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, 'https://dns.hetzner.com/api/v1/records?zone_id=' . $this->zone_id);

        // set method
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        // return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // set headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Auth-API-Token: ' . $this->auth_api_token,
        ]);

        // send the request and save response to $response
        $response = curl_exec($ch);

        // stop if fails
        if (!$response) {
        die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }

        echo 'HTTP Status Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL;
        echo 'Response Body: ' . $response . PHP_EOL;

        // close curl resource to free up system resources 
        curl_close($ch);
    }
}
