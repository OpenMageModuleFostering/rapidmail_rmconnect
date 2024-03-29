<?php

/**
 * Catalog API Extension
 *
 * @category   Rapidmail
 * @package    Rapidmail_RMConnect
 */

class Rapidmail_RMConnect_Model_Catalog_Api_V2 extends Mage_Api2_Model_Resource
{

    /**
     * Custom product list API method.
     * The custom implementation will:
     * - only load the fields we need
     * - give us a proper URL and image path
     * - prevent memory problems caused by the default implementation due to categories being loaded
     *
     * @return array
     */
    public function productList() {

        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect(array(
                'id',
                'sku',
                'name',
                'image',
                'url_path',
                'price',
                'special_price',
                'special_from_date',
                'special_to_date',
                'description',
                'short_description',
                'created_at',
                'updated_at'
            ));

        $result = array();

        foreach ($collection as $product) {

            $result[] = array(
                'product_id' => $product->getId(),
                'sku' => $product->getSku(),
                'name' => $product->getName(),
                'image' => $product->getImage() != 'no_selection' ? Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage() : '',
                'url_path' => $product->getUrlPath(),
                'price' => $product->getPrice(),
                'special_price' => $product->getSpecialPrice(),
                'special_from_date' => $product->getSpecialFromDate(),
                'special_to_date' => $product->getSpecialToDate(),
                'description' => $product->getDescription(),
                'short_description' => $product->getShortDescription(),
                'created_at' => $product->getCreatedAt(),
                'updated_at' => $product->getUpdatedAt()
            );

        }

        return $result;

    }

}
