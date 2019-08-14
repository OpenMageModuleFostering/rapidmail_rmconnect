<?php

/**
 * Newsletters subscribers API Extension
 *
 * @category   Rapidmail
 * @package    Rapidmail_RMConnect
 */

class Rapidmail_RMConnect_Model_Version_Api_V2 extends Mage_Api_Model_Resource_Abstract
{

    /**
     * Returns Shop Version
     *
     * @return array
     */
    public function shopVersion()
    {

        $result = array();

        // Get Shop Version

        $result[] = array(
            'shop_version' => Mage::getVersion(),
            'shop_edition' => Mage::getEdition(),
            'extension_version' => (string)Mage::getConfig()->getModuleConfig('Rapidmail_RMConnect')->version
        );

        return $result;

    }
}

?>
