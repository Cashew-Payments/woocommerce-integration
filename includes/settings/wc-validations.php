<?php

function validate_curr($curr)
{
    $allowedCurrencies = ['AED', 'SAR'];

    return in_array($curr, $allowedCurrencies);
}
