<?php
/*
/* Spotii Authentications
*/
function spotiiAuth($th, $addon = "", $currency = null)
{

    $auth_url =  $th->auth . 'identity/store/authorize';
    if ($th->enabled == "yes") {
        $storeUrl =  $th->storeUrl;
        $cashewPrivateKey = $th->cashewPrivateKey;
        if (empty($public_key) || empty($private_key)) {
            error_log("Keys does not exist [WP_Error_Spotii Authentication]: ");
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
print_r($payload);
        $response = wp_remote_post($auth_url, $payload);

        if (is_wp_error($response)) {
            error_log("Exception [WP_Error_Spotii Authentication]: " . $response);
            throw new Exception(__('Network connection issue'));
        }
        if (empty($response['body'])) {
            error_log("Response Body Empty [WP_Error_Spotii Authentication]: " . $response);
            throw new Exception(__('Empty response body'));
        }

        $response_body = $response['body'];
        $response_body_arr = json_decode($response_body, true);

        if (array_key_exists('token', $response_body_arr['data'])) {
            $th->token = $response_body_arr['data']['token'];
            return $response_body_arr['data']['token'];
        } else {
            error_log("Error on authentication: " . $response_body);
        }
    } else {
        error_log("Response Body Empty [WP_Error_Spotii Authentication]: ");
        throw new Exception(__('Plugin disabled'));
    }
}
