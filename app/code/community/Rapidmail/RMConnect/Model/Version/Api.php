<?php

/**
 * Newsletters subscribers API Extension
 *
 * @category   Rapidmail
 * @package    Rapidmail_RMConnect
 */

class Rapidmail_RMConnect_Model_Version_Api extends Mage_Api_Model_Resource_Abstract {

    /**
     * Returns Shop Version
     *
     * @return array
     */
    public function shopVersion() {

        // Wrap this in additional array to conform to WSDL
        return array(
            Mage::helper('rmconnect')
                ->getShopVersion()
        );

    }

}
