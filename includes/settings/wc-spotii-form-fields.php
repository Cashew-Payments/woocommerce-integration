<?php
/*
/* Form Fields 
*/
function form_fields($th)
{

    $th->form_fields = array(
        'enabled' => array(
            'title' => 'Enable/Disable',
            'label' => 'cashew Payments, buy now, pay later',
            'type' => 'checkbox',
            'description' => __('Don&rsquo;t have a Spotii Merchant account yet?', 'woocommerce') . ' ' . '<a href="https://dashboard.spotii.me/signup" target="_blank">' . __('Apply online today!', 'woocommerce') . '</a>',
            'default' => 'no',
        ),
        'title' => array(
            'title' => 'Title',
            'type' => 'text',
            'description' => 'This controls the title that the user sees during checkout',
            'default' => 'cashew Payments, buy now, pay later',
            'desc_tip' => true,
        ),
        'description' => array(
            'title' => 'Description',
            'type' => 'textarea',
            'description' => 'This controls the description which the user sees during checkout',
            'default' => 'cashew Payments, buy now, pay later',
        ),
        'testmode' => array(
            'title' => 'Test Mode',
            'label' => 'Enable Test Mode',
            'type' => 'checkbox',
            'description' => 'Place the payment gateway in test mode using test API keys',
            'default' => 'no',
            'desc_tip' => false,
        ),
        'store_url' => array(
            'title' => 'Live Public Key',
            'type' => 'text',
        ),
        'cashew_private_key' => array(
            'title' => 'Live Private Key',
            'type' => 'password',
        )
    );

    $widget = array(
        'order_minimum' => array(
            'title' => 'Order minimum',
            'type' => 'text',
            'default' => '200',
            'description' => 'The order minimum is set in AED'
        ),
        'order_maximum' => array(
            'title' => 'Order maximum',
            'type' => 'text',
            'default' => '200',
            'description' => 'The order maximum is set in AED'
        )
    );
    $th->form_fields += $widget;
}
