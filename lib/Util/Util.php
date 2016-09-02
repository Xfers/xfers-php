<?php

namespace Xfers\Util;

use Xfers\XfersObject;

abstract class Util
{
    private static $isMbstringAvailable = null;

    /**
     * Whether the provided array (or other) is a list rather than a dictionary.
     *
     * @param array|mixed $array
     * @return boolean True if the given object is a list.
     */
    public static function isList($array)
    {
        if (!is_array($array)) {
            return false;
        }

        // TODO: generally incorrect, but it's correct given Xfers's response
        foreach (array_keys($array) as $k) {
            if (!is_numeric($k)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Recursively converts the PHP Xfers object to an array.
     *
     * @param array $values The PHP Xfers object to convert.
     * @return array
     */
    public static function convertXfersObjectToArray($values)
    {
        $results = array();
        foreach ($values as $k => $v) {
            // FIXME: this is an encapsulation violation
            if ($k[0] == '_') {
                continue;
            }
            if ($v instanceof XfersObject) {
                $results[$k] = $v->__toArray(true);
            } elseif (is_array($v)) {
                $results[$k] = self::convertXfersObjectToArray($v);
            } else {
                $results[$k] = $v;
            }
        }
        return $results;
    }

    /**
     * Converts a response from the Xfers API to the corresponding PHP object.
     *
     * @param array $resp The response from the Xfers API.
     * @param array $opts
     * @return XfersObject|array
     */
    public static function convertToXfersObject($resp, $opts)
    {
        $types = array(
            'account' => 'Xfers\\Account',
            'alipay_account' => 'Xfers\\AlipayAccount',
            'bank_account' => 'Xfers\\BankAccount',
            'balance_transaction' => 'Xfers\\BalanceTransaction',
            'card' => 'Xfers\\Card',
            'charge' => 'Xfers\\Charge',
            'country_spec' => 'Xfers\\CountrySpec',
            'coupon' => 'Xfers\\Coupon',
            'customer' => 'Xfers\\Customer',
            'dispute' => 'Xfers\\Dispute',
            'list' => 'Xfers\\Collection',
            'invoice' => 'Xfers\\Invoice',
            'invoiceitem' => 'Xfers\\InvoiceItem',
            'event' => 'Xfers\\Event',
            'file' => 'Xfers\\FileUpload',
            'token' => 'Xfers\\Token',
            'transfer' => 'Xfers\\Transfer',
            'order' => 'Xfers\\Order',
            'order_return' => 'Xfers\\OrderReturn',
            'plan' => 'Xfers\\Plan',
            'product' => 'Xfers\\Product',
            'recipient' => 'Xfers\\Recipient',
            'refund' => 'Xfers\\Refund',
            'sku' => 'Xfers\\SKU',
            'source' => 'Xfers\\Source',
            'subscription' => 'Xfers\\Subscription',
            'three_d_secure' => 'Xfers\\ThreeDSecure',
            'fee_refund' => 'Xfers\\ApplicationFeeRefund',
            'bitcoin_receiver' => 'Xfers\\BitcoinReceiver',
            'bitcoin_transaction' => 'Xfers\\BitcoinTransaction',
        );
        if (self::isList($resp)) {
            $mapped = array();
            foreach ($resp as $i) {
                array_push($mapped, self::convertToXfersObject($i, $opts));
            }
            return $mapped;
        } elseif (is_array($resp)) {
            if (isset($resp['object']) && is_string($resp['object']) && isset($types[$resp['object']])) {
                $class = $types[$resp['object']];
            } else {
                $class = 'Xfers\\XfersObject';
            }
            return $class::constructFrom($resp, $opts);
        } else {
            return $resp;
        }
    }

    /**
     * @param string|mixed $value A string to UTF8-encode.
     *
     * @return string|mixed The UTF8-encoded string, or the object passed in if
     *    it wasn't a string.
     */
    public static function utf8($value)
    {
        if (self::$isMbstringAvailable === null) {
            self::$isMbstringAvailable = function_exists('mb_detect_encoding');

            if (!self::$isMbstringAvailable) {
                trigger_error("It looks like the mbstring extension is not enabled. " .
                    "UTF-8 strings will not properly be encoded. Ask your system " .
                    "administrator to enable the mbstring extension, or write to " .
                    "support@Xfers.com if you have any questions.", E_USER_WARNING);
            }
        }

        if (is_string($value) && self::$isMbstringAvailable && mb_detect_encoding($value, "UTF-8", true) != "UTF-8") {
            return utf8_encode($value);
        } else {
            return $value;
        }
    }
}