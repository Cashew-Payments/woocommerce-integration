<?php
/*
/* Currency Converter
*/

/*
/* validate Currency
*/
function validate_curr($curr)
{

    if ($curr == "AED" || $curr == "SAR") {
        return true;
    } else {
        return false;
    }
}
