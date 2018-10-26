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
 * Observer model
 *
 * @category    Shopgo
 * @package     Shopgo_SMS
 * @author      Shopgo <Support@shopgo.me>
 */


class Shopgo_SMS_Model_Observer
{
     const XML_PATH_STATUS_MESSAGE = 'sms/order_status/textarea';

    public function trackNewOrder(Varien_Event_Observer $observer)
    {
        $data = array(
        'phoneNumber'  => $observer->getEvent()->getOrder()->getBillingAddress()->getTelephone(),
        'countryId'    => $observer->getEvent()->getOrder()->getBillingAddress()->getCountryId(),
        'customerName' => $observer->getEvent()->getOrder()->getCustomerName(),
        'orderId'      => $observer->getEvent()->getOrder()->getIncrementId()
        );
        Mage::helper('sms')->sendPlaceSms($data);
    }

    public function changeOrderStatus(Varien_Event_Observer $observer)
    {
        $shipment = $observer->getEvent()->getShipment();
        $order    = $shipment->getOrder();

        Mage::app()->setCurrentStore($order->getStoreId());
        $data = array(
            'phoneNumber'  => $order->getBillingAddress()->getTelephone(),
            'countryId'    => $order->getBillingAddress()->getCountryId(),
            'customerName' => $order->getCustomerName(),
            'orderId'      => $order->getIncrementId()
        );

        Mage::helper('sms')->sendStatusSms($data);
    }
}
