<?php

/**
 * Data Helper Extension
 *
 * @category   Rapidmail
 * @package    Rapidmail_RMConnect
 */
class Rapidmail_RMConnect_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * Get magento shop version info
     *
     * @return array
     */
    public function getShopVersion() {

        return array(
            'shop_version' => Mage::getVersion(),
            'shop_edition' => Mage::getEdition(),
            'extension_version' => (string)Mage::getConfig()->getModuleConfig('Rapidmail_RMConnect')->version
        );

    }

}