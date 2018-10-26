<?php
/**
 * ShopGo
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category    Shopgo
 * @package     Shopgo_SMS
 * @copyright   Copyright (c) 2015 ShopGo. (http://www.shopgo.me)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Data helper
 *
 * @category    Shopgo
 * @package     Shopgo_SMS
 * @author      Shopgo <support@shopgo.me>
 */

require_once(Mage::getBaseDir('lib') . '/twilio-php/Services/Twilio.php');

class Shopgo_SMS_Helper_Data extends Mage_Core_Helper_Data
{


   // $hubSpotApiKey = Mage::getStoreConfig('hubspot/general/hapikey');

    const XML_PATH_ENABLED        = 'sms/general/enabled';
    const INVALID_SENDER_ID       =  21612;
    const XML_PATH_SENDER_ID      = 'sms/general/senderid';
    const XML_PATH_TWILIO_SID     = 'sms/general/twsid';
    const XML_PATH_AUTH_TOKEN     = 'sms/general/twtoken';
    const XML_PATH_TWILIO_NUMBER  = 'sms/general/vtn';
    const XML_PATH_PLACE_MESSAGE  = 'sms/order/textarea';
    const XML_PATH_STATUS_MESSAGE = 'sms/order_status/textarea';

    



    function preparePhone($number, $countryCode = null)
    {
        $countryCodes = array();
        $countryCodes[] = array("code" => "AF", "d_code" => "93");
        $countryCodes[] = array("code" => "AL", "d_code" => "355");
        $countryCodes[] = array("code" => "DZ", "d_code" => "213");
        $countryCodes[] = array("code" => "AS", "d_code" => "1");
        $countryCodes[] = array("code" => "AD", "d_code" => "376");
        $countryCodes[] = array("code" => "AO", "d_code" => "244");
        $countryCodes[] = array("code" => "AI", "d_code" => "1");
        $countryCodes[] = array("code" => "AG", "d_code" => "1");
        $countryCodes[] = array("code" => "AR", "d_code" => "54");
        $countryCodes[] = array("code" => "AM", "d_code" => "374");
        $countryCodes[] = array("code" => "AW", "d_code" => "297");
        $countryCodes[] = array("code" => "AU", "d_code" => "61");
        $countryCodes[] = array("code" => "AT", "d_code" => "43");
        $countryCodes[] = array("code" => "AZ", "d_code" => "994");
        $countryCodes[] = array("code" => "BH", "d_code" => "973");
        $countryCodes[] = array("code" => "BD", "d_code" => "880");
        $countryCodes[] = array("code" => "BB", "d_code" => "1");
        $countryCodes[] = array("code" => "BY", "d_code" => "375");
        $countryCodes[] = array("code" => "BE", "d_code" => "32");
        $countryCodes[] = array("code" => "BZ", "d_code" => "501");
        $countryCodes[] = array("code" => "BJ", "d_code" => "229");
        $countryCodes[] = array("code" => "BM", "d_code" => "1");
        $countryCodes[] = array("code" => "BT", "d_code" => "975");
        $countryCodes[] = array("code" => "BO", "d_code" => "591");
        $countryCodes[] = array("code" => "BA", "d_code" => "387");
        $countryCodes[] = array("code" => "BW", "d_code" => "267");
        $countryCodes[] = array("code" => "BR", "d_code" => "55");
        $countryCodes[] = array("code" => "IO", "d_code" => "246");
        $countryCodes[] = array("code" => "VG", "d_code" => "1");
        $countryCodes[] = array("code" => "BN", "d_code" => "673");
        $countryCodes[] = array("code" => "BG", "d_code" => "359");
        $countryCodes[] = array("code" => "BF", "d_code" => "226");
        $countryCodes[] = array("code" => "MM", "d_code" => "95");
        $countryCodes[] = array("code" => "BI", "d_code" => "257");
        $countryCodes[] = array("code" => "KH", "d_code" => "855");
        $countryCodes[] = array("code" => "CM", "d_code" => "237");
        $countryCodes[] = array("code" => "CA", "d_code" => "1");
        $countryCodes[] = array("code" => "CV", "d_code" => "238");
        $countryCodes[] = array("code" => "KY", "d_code" => "1");
        $countryCodes[] = array("code" => "CF", "d_code" => "236");
        $countryCodes[] = array("code" => "TD", "d_code" => "235");
        $countryCodes[] = array("code" => "CL", "d_code" => "56");
        $countryCodes[] = array("code" => "CN", "d_code" => "86");
        $countryCodes[] = array("code" => "CO", "d_code" => "57");
        $countryCodes[] = array("code" => "KM", "d_code" => "269");
        $countryCodes[] = array("code" => "CK", "d_code" => "682");
        $countryCodes[] = array("code" => "CR", "d_code" => "506");
        $countryCodes[] = array("code" => "CI", "d_code" => "225");
        $countryCodes[] = array("code" => "HR", "d_code" => "385");
        $countryCodes[] = array("code" => "CU", "d_code" => "53");
        $countryCodes[] = array("code" => "CY", "d_code" => "357");
        $countryCodes[] = array("code" => "CZ", "d_code" => "420");
        $countryCodes[] = array("code" => "CD", "d_code" => "243");
        $countryCodes[] = array("code" => "DK", "d_code" => "45");
        $countryCodes[] = array("code" => "DJ", "d_code" => "253");
        $countryCodes[] = array("code" => "DM", "d_code" => "1");
        $countryCodes[] = array("code" => "DO", "d_code" => "1");
        $countryCodes[] = array("code" => "EC", "d_code" => "593");
        $countryCodes[] = array("code" => "EG", "d_code" => "20");
        $countryCodes[] = array("code" => "SV", "d_code" => "503");
        $countryCodes[] = array("code" => "GQ", "d_code" => "240");
        $countryCodes[] = array("code" => "ER", "d_code" => "291");
        $countryCodes[] = array("code" => "EE", "d_code" => "372");
        $countryCodes[] = array("code" => "ET", "d_code" => "251");
        $countryCodes[] = array("code" => "FK", "d_code" => "500");
        $countryCodes[] = array("code" => "FO", "d_code" => "298");
        $countryCodes[] = array("code" => "FM", "d_code" => "691");
        $countryCodes[] = array("code" => "FJ", "d_code" => "679");
        $countryCodes[] = array("code" => "FI", "d_code" => "358");
        $countryCodes[] = array("code" => "FR", "d_code" => "33");
        $countryCodes[] = array("code" => "GF", "d_code" => "594");
        $countryCodes[] = array("code" => "PF", "d_code" => "689");
        $countryCodes[] = array("code" => "GA", "d_code" => "241");
        $countryCodes[] = array("code" => "GE", "d_code" => "995");
        $countryCodes[] = array("code" => "DE", "d_code" => "49");
        $countryCodes[] = array("code" => "GH", "d_code" => "233");
        $countryCodes[] = array("code" => "GI", "d_code" => "350");
        $countryCodes[] = array("code" => "GR", "d_code" => "30");
        $countryCodes[] = array("code" => "GL", "d_code" => "299");
        $countryCodes[] = array("code" => "GD", "d_code" => "1");
        $countryCodes[] = array("code" => "GP", "d_code" => "590");
        $countryCodes[] = array("code" => "GU", "d_code" => "1");
        $countryCodes[] = array("code" => "GT", "d_code" => "502");
        $countryCodes[] = array("code" => "GN", "d_code" => "224");
        $countryCodes[] = array("code" => "GW", "d_code" => "245");
        $countryCodes[] = array("code" => "GY", "d_code" => "592");
        $countryCodes[] = array("code" => "HT", "d_code" => "509");
        $countryCodes[] = array("code" => "HN", "d_code" => "504");
        $countryCodes[] = array("code" => "HK", "d_code" => "852");
        $countryCodes[] = array("code" => "HU", "d_code" => "36");
        $countryCodes[] = array("code" => "IS", "d_code" => "354");
        $countryCodes[] = array("code" => "IN", "d_code" => "91");
        $countryCodes[] = array("code" => "ID", "d_code" => "62");
        $countryCodes[] = array("code" => "IR", "d_code" => "98");
        $countryCodes[] = array("code" => "IQ", "d_code" => "964");
        $countryCodes[] = array("code" => "IE", "d_code" => "353");
        $countryCodes[] = array("code" => "IL", "d_code" => "972");
        $countryCodes[] = array("code" => "IT", "d_code" => "39");
        $countryCodes[] = array("code" => "JM", "d_code" => "1");
        $countryCodes[] = array("code" => "JP", "d_code" => "81");
        $countryCodes[] = array("code" => "JO", "d_code" => "962");
        $countryCodes[] = array("code" => "KZ", "d_code" => "7");
        $countryCodes[] = array("code" => "KE", "d_code" => "254");
        $countryCodes[] = array("code" => "KI", "d_code" => "686");
        $countryCodes[] = array("code" => "XK", "d_code" => "381");
        $countryCodes[] = array("code" => "KW", "d_code" => "965");
        $countryCodes[] = array("code" => "KG", "d_code" => "996");
        $countryCodes[] = array("code" => "LA", "d_code" => "856");
        $countryCodes[] = array("code" => "LV", "d_code" => "371");
        $countryCodes[] = array("code" => "LB", "d_code" => "961");
        $countryCodes[] = array("code" => "LS", "d_code" => "266");
        $countryCodes[] = array("code" => "LR", "d_code" => "231");
        $countryCodes[] = array("code" => "LY", "d_code" => "218");
        $countryCodes[] = array("code" => "LI", "d_code" => "423");
        $countryCodes[] = array("code" => "LT", "d_code" => "370");
        $countryCodes[] = array("code" => "LU", "d_code" => "352");
        $countryCodes[] = array("code" => "MO", "d_code" => "853");
        $countryCodes[] = array("code" => "MK", "d_code" => "389");
        $countryCodes[] = array("code" => "MG", "d_code" => "261");
        $countryCodes[] = array("code" => "MW", "d_code" => "265");
        $countryCodes[] = array("code" => "MY", "d_code" => "60");
        $countryCodes[] = array("code" => "MV", "d_code" => "960");
        $countryCodes[] = array("code" => "ML", "d_code" => "223");
        $countryCodes[] = array("code" => "MT", "d_code" => "356");
        $countryCodes[] = array("code" => "MH", "d_code" => "692");
        $countryCodes[] = array("code" => "MQ", "d_code" => "596");
        $countryCodes[] = array("code" => "MR", "d_code" => "222");
        $countryCodes[] = array("code" => "MU", "d_code" => "230");
        $countryCodes[] = array("code" => "YT", "d_code" => "262");
        $countryCodes[] = array("code" => "MX", "d_code" => "52");
        $countryCodes[] = array("code" => "MD", "d_code" => "373");
        $countryCodes[] = array("code" => "MC", "d_code" => "377");
        $countryCodes[] = array("code" => "MN", "d_code" => "976");
        $countryCodes[] = array("code" => "ME", "d_code" => "382");
        $countryCodes[] = array("code" => "MS", "d_code" => "1");
        $countryCodes[] = array("code" => "MA", "d_code" => "212");
        $countryCodes[] = array("code" => "MZ", "d_code" => "258");
        $countryCodes[] = array("code" => "NA", "d_code" => "264");
        $countryCodes[] = array("code" => "NR", "d_code" => "674");
        $countryCodes[] = array("code" => "NP", "d_code" => "977");
        $countryCodes[] = array("code" => "NL", "d_code" => "31");
        $countryCodes[] = array("code" => "AN", "d_code" => "599");
        $countryCodes[] = array("code" => "NC", "d_code" => "687");
        $countryCodes[] = array("code" => "NZ", "d_code" => "64");
        $countryCodes[] = array("code" => "NI", "d_code" => "505");
        $countryCodes[] = array("code" => "NE", "d_code" => "227");
        $countryCodes[] = array("code" => "NG", "d_code" => "234");
        $countryCodes[] = array("code" => "NU", "d_code" => "683");
        $countryCodes[] = array("code" => "NF", "d_code" => "672");
        $countryCodes[] = array("code" => "KP", "d_code" => "850");
        $countryCodes[] = array("code" => "MP", "d_code" => "1");
        $countryCodes[] = array("code" => "NO", "d_code" => "47");
        $countryCodes[] = array("code" => "OM", "d_code" => "968");
        $countryCodes[] = array("code" => "PK", "d_code" => "92");
        $countryCodes[] = array("code" => "PW", "d_code" => "680");
        $countryCodes[] = array("code" => "PS", "d_code" => "970");
        $countryCodes[] = array("code" => "PA", "d_code" => "507");
        $countryCodes[] = array("code" => "PG", "d_code" => "675");
        $countryCodes[] = array("code" => "PY", "d_code" => "595");
        $countryCodes[] = array("code" => "PE", "d_code" => "51");
        $countryCodes[] = array("code" => "PH", "d_code" => "63");
        $countryCodes[] = array("code" => "PL", "d_code" => "48");
        $countryCodes[] = array("code" => "PT", "d_code" => "351");
        $countryCodes[] = array("code" => "PR", "d_code" => "1");
        $countryCodes[] = array("code" => "QA", "d_code" => "974");
        $countryCodes[] = array("code" => "CG", "d_code" => "242");
        $countryCodes[] = array("code" => "RE", "d_code" => "262");
        $countryCodes[] = array("code" => "RO", "d_code" => "40");
        $countryCodes[] = array("code" => "RU", "d_code" => "7");
        $countryCodes[] = array("code" => "RW", "d_code" => "250");
        $countryCodes[] = array("code" => "BL", "d_code" => "590");
        $countryCodes[] = array("code" => "SH", "d_code" => "290");
        $countryCodes[] = array("code" => "KN", "d_code" => "1");
        $countryCodes[] = array("code" => "MF", "d_code" => "590");
        $countryCodes[] = array("code" => "PM", "d_code" => "508");
        $countryCodes[] = array("code" => "VC", "d_code" => "1");
        $countryCodes[] = array("code" => "WS", "d_code" => "685");
        $countryCodes[] = array("code" => "SM", "d_code" => "378");
        $countryCodes[] = array("code" => "ST", "d_code" => "239");
        $countryCodes[] = array("code" => "SA", "d_code" => "966");
        $countryCodes[] = array("code" => "SN", "d_code" => "221");
        $countryCodes[] = array("code" => "RS", "d_code" => "381");
        $countryCodes[] = array("code" => "SC", "d_code" => "248");
        $countryCodes[] = array("code" => "SL", "d_code" => "232");
        $countryCodes[] = array("code" => "SG", "d_code" => "65");
        $countryCodes[] = array("code" => "SK", "d_code" => "421");
        $countryCodes[] = array("code" => "SI", "d_code" => "386");
        $countryCodes[] = array("code" => "SB", "d_code" => "677");
        $countryCodes[] = array("code" => "SO", "d_code" => "252");
        $countryCodes[] = array("code" => "ZA", "d_code" => "27");
        $countryCodes[] = array("code" => "KR", "d_code" => "82");
        $countryCodes[] = array("code" => "ES", "d_code" => "34");
        $countryCodes[] = array("code" => "LK", "d_code" => "94");
        $countryCodes[] = array("code" => "LC", "d_code" => "1");
        $countryCodes[] = array("code" => "SD", "d_code" => "249");
        $countryCodes[] = array("code" => "SR", "d_code" => "597");
        $countryCodes[] = array("code" => "SZ", "d_code" => "268");
        $countryCodes[] = array("code" => "SE", "d_code" => "46");
        $countryCodes[] = array("code" => "CH", "d_code" => "41");
        $countryCodes[] = array("code" => "SY", "d_code" => "963");
        $countryCodes[] = array("code" => "TW", "d_code" => "886");
        $countryCodes[] = array("code" => "TJ", "d_code" => "992");
        $countryCodes[] = array("code" => "TZ", "d_code" => "255");
        $countryCodes[] = array("code" => "TH", "d_code" => "66");
        $countryCodes[] = array("code" => "BS", "d_code" => "1");
        $countryCodes[] = array("code" => "GM", "d_code" => "220");
        $countryCodes[] = array("code" => "TL", "d_code" => "670");
        $countryCodes[] = array("code" => "TG", "d_code" => "228");
        $countryCodes[] = array("code" => "TK", "d_code" => "690");
        $countryCodes[] = array("code" => "TO", "d_code" => "676");
        $countryCodes[] = array("code" => "TT", "d_code" => "1");
        $countryCodes[] = array("code" => "TN", "d_code" => "216");
        $countryCodes[] = array("code" => "TR", "d_code" => "90");
        $countryCodes[] = array("code" => "TM", "d_code" => "993");
        $countryCodes[] = array("code" => "TC", "d_code" => "1");
        $countryCodes[] = array("code" => "TV", "d_code" => "688");
        $countryCodes[] = array("code" => "UG", "d_code" => "256");
        $countryCodes[] = array("code" => "UA", "d_code" => "380");
        $countryCodes[] = array("code" => "AE", "d_code" => "971");
        $countryCodes[] = array("code" => "GB", "d_code" => "44");
        $countryCodes[] = array("code" => "US", "d_code" => "1");
        $countryCodes[] = array("code" => "UY", "d_code" => "598");
        $countryCodes[] = array("code" => "VI", "d_code" => "1");
        $countryCodes[] = array("code" => "UZ", "d_code" => "998");
        $countryCodes[] = array("code" => "VU", "d_code" => "678");
        $countryCodes[] = array("code" => "VA", "d_code" => "39");
        $countryCodes[] = array("code" => "VE", "d_code" => "58");
        $countryCodes[] = array("code" => "VN", "d_code" => "84");
        $countryCodes[] = array("code" => "WF", "d_code" => "681");
        $countryCodes[] = array("code" => "YE", "d_code" => "967");
        $countryCodes[] = array("code" => "ZM", "d_code" => "260");
        $countryCodes[] = array("code" => "ZW", "d_code" => "263");
    
        $result = '';

        if (strlen($number) > 3) {
            if (substr($number, 0, 2) == "00") {
                $result = "+" . substr($number, 2);
            } elseif (substr($number, 0, 1) == "+") {
                $result = $number;
            } else {
                if (!empty($countryCode)) {
                    $countryCode = strtoupper($countryCode);
                    foreach ($countryCodes as $val) {
                        if ($countryCode == $val['code']) {
                            if (substr($number, 0, 1) == "0") {
                                $result = "+" . $val['d_code'] . substr($number, 1);
                            } else {
                                $result = "+" . $val['d_code'] . $number;
                            }
                            break;
                        }
                    }
                }
            }
        }

    return $result;
}

    /**
     * Check whether the extension is enabled or not
     *
     * @return bool
     */
    public function isEnabled()
    {
       return Mage::getStoreConfig(self::XML_PATH_ENABLED);
    }

    /**
     * Prepare message text
     *
     * @return bool
     */
    public function buildMessage($messagType, $data )
    {
        $messagetext = Mage::getStoreConfig($messagType);
        $messagetext = str_replace("{customer_name}", $data['customerName'], $messagetext);
        $messagetext = str_replace("{order_id}", $data['orderId'], $messagetext);
        $messagetext = str_replace("{shop_name}", Mage::getStoreConfig('general/store_information/name'), $messagetext);

        return $messagetext;
    }



    /**
     * Send SMS Message
     *
     * @param Array $data
     */
    public function sendPlaceSms($data)
    {
        $sid      = Mage::getStoreConfig(self::XML_PATH_TWILIO_SID);
        $token    = Mage::getStoreConfig(self::XML_PATH_AUTH_TOKEN);
        $Phone    = Mage::getStoreConfig(self::XML_PATH_TWILIO_NUMBER);
        $senderId = Mage::getStoreConfig(self::XML_PATH_SENDER_ID);


        $messagetext = $this->buildMessage(self::XML_PATH_PLACE_MESSAGE, $data);

        try{
            $client  = new Services_Twilio($sid, $token);
            $message = $client->account->messages->sendMessage(
                    $senderId, // From a valid Twilio number
                    $this->preparePhone($data['phoneNumber'],$data['countryId']), // Text this number
                    $messagetext
                    );
            if (Mage::getStoreConfig('sms/general/debug')){
                 Mage::log($message,null,'sms.log');
            }
        }
        catch(Exception $e){
            if ($e->getCode() == self::INVALID_SENDER_ID){

                try{
                    $message = $client->account->messages->sendMessage(
                                $Phone, // From a valid Twilio number
                                $this->preparePhone($data['phoneNumber'],$data['countryId']), // Text this number
                                $messagetext
                                );
                    if (Mage::getStoreConfig('sms/general/debug')){
                        Mage::log($message,null,'sms.log');
                    }
                }
                catch (Exception $e){
                    if (Mage::getStoreConfig('sms/general/debug')){
                        Mage::log($e->getMessage(),null,'sms.log');
                        Mage::log($e->getCode(),null,'sms.log');
                    }
                }
            }
            if (Mage::getStoreConfig('sms/general/debug')){
                Mage::log($e->getMessage(),null,'sms.log');
                Mage::log($e->getCode(),null,'sms.log');
            }
        }
    }

    /**
     * Send SMS Message
     *
     * @param Array $data
     */
    public function sendStatusSms($data)
    {
        $sid      = Mage::getStoreConfig(self::XML_PATH_TWILIO_SID);
        $token    = Mage::getStoreConfig(self::XML_PATH_AUTH_TOKEN);
        $Phone    = Mage::getStoreConfig(self::XML_PATH_TWILIO_NUMBER);
        $senderId = Mage::getStoreConfig(self::XML_PATH_SENDER_ID);

        $messagetext = $this->buildMessage(self::XML_PATH_STATUS_MESSAGE, $data);
       
        try{
            $client  = new Services_Twilio($sid, $token);
            $message = $client->account->messages->sendMessage(
                        $senderId,
                        $this->preparePhone($data['phoneNumber'],$data['countryId']),
                        $messagetext);
            if (Mage::getStoreConfig('sms/general/debug')){
                 Mage::log($message,null,'sms.log');
            }
        }
        catch(Exception $e){
            if ($e->getCode() == self::INVALID_SENDER_ID){

                try{
                    $message = $client->account->messages->sendMessage(
                                $Phone,
                                $this->preparePhone($data['phoneNumber'],$data['countryId']),
                                $messagetext
                                );
                    if (Mage::getStoreConfig('sms/general/debug')){
                        Mage::log($message,null,'sms.log');
                    }
                }
                catch (Exception $e){
                    if (Mage::getStoreConfig('sms/general/debug')){
                        Mage::log($e->getMessage(),null,'sms.log');
                        Mage::log($e->getCode(),null,'sms.log');
                    }
                }
            }
            if (Mage::getStoreConfig('sms/general/debug')){
                Mage::log($e->getMessage(),null,'sms.log');
                Mage::log($e->getCode(),null,'sms.log');
            }
        }
    }
}