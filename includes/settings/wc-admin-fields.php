<?php
function form_fields($th)
{

    $th->form_fields = array(
        'enabled' => array(
            'title' => 'Enable/Disable',
            'label' => 'cashew Payments, buy now, pay later',
            'type' => 'checkbox',
            'description' => '',
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
        'sandbox' => array(
            'title' => 'Sandbox',
            'label' => 'Enable sandbox',
            'type' => 'checkbox',
            'description' => 'Use sandbox api for test',
            'default' => 'yes',
            'desc_tip' => false,
        ),
        'cashew_private_key' => array(
            'title' => 'Cashew private key',
            'type' => 'password',
        )
    );

    $widget = array(
        'order_minimum' => array(
            'title' => 'Order minimum',
            'type' => 'text',
            'default' => '0',
            'description' => 'The order minimum amount for the cart'
        ),
        'order_maximum' => array(
            'title' => 'Order maximum',
            'type' => 'text',
            'default' => '4000',
            'description' => 'The order maximum amount for the cart'
        )
    );
    $th->form_fields += $widget;
}
