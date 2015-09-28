<?php


class DEG_NewRelic_Model_Observer
{
    /**
     * Disables New Relic's Real-time User Monitoring script
     * from being inserted into the response when the response is
     * in JSON format since this insertion may produce invalid JSON.
     * See http://magento.stackexchange.com/q/21602
     *
     * @param $observer
     */
    public function removeRumFromJSResponses($observer)
    {
        if (extension_loaded('newrelic')) {
            $front = $observer->getFront();
            $response = $front->getResponse()->getBody();
            if (Mage::helper('core')->jsonDecode($response)) {
                newrelic_disable_autorum();
            }
        }
    }
}
