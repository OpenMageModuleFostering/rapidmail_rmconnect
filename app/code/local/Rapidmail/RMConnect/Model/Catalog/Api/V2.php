<?php

/**
 * Catalog API Extension
 *
 * @category   Rapidmail
 * @package    Rapidmail_RMConnect
 */

class Rapidmail_RMConnect_Model_Catalog_Api_V2 extends Mage_Api_Model_Resource_Abstract
{

    /**
     * Returns products
     *
     * @return array
     */
    public function productList()
    {

        $collection = Mage::getModel('catalog/product')->getCollection()
                                                       ->addAttributeToSelect('*');

        $result = array();

        foreach ($collection as $product) {

            $result[] = array(
                'product_id' => $product->getId(),
                'sku'        => $product->getSku(),
                'name'       => $product->getName(),
                'image' => $product->getImage() != 'no_selection' ? $product->getImage() : '',
                'url_path' => $product->getUrlPath(),
                'price' => $product->getPrice(),
                'description' => $product->getDescription(),
                'short_description' => $product->getShortDescription(),
                'created_at' => $product->getCreatedAt(),
                'updated_at' => $product->getUpdatedAt()
            );

        }

        return $result;

    }

}

?>
