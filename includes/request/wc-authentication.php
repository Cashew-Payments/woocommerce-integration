<?php
/*
/* API Authentication
*/
function cashewApiAuth($th, $addon = "", $currency = null)
{

    $auth_url =  $th->auth . 'identity/store/authorize';
    if ($th->enabled == "yes") {
        $storeUrl =  get_site_url();
        $cashewPrivateKey = $th->cashewPrivateKey;
        
        if (empty($cashewPrivateKey)) {
            throw new Exception(__('Keys does not exist'));
        }

        $headers = array(
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'storeUrl' => $storeUrl,
            'cashewSecretKey' => $cashewPrivateKey
        );

        $payload = array(
            'method' => 'POST',
            'headers' => $headers,
            'timeout' => 20
        );

        $response = wp_remote_post($auth_url, $payload);
        
        if (is_wp_error($response)) {
            throw new Exception(__('Network connection issue'));
        }
        if (empty($response['body'])) {
            throw new Exception(__('Empty response body'));
        }

        $response_body = $response['body'];
        $response_body_arr = json_decode($response_body, true);

        if (array_key_exists('token', $response_body_arr['data'])) {
            $th->token = $response_body_arr['data']['token'];
            return $response_body_arr['data']['token'];
        } else {
            throw new Exception(__('Error on authentication'));
        }
    } else {
        throw new Exception(__('Plugin disabled'));
    }
}
