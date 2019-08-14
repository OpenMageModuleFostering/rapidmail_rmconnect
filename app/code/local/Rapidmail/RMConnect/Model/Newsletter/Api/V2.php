<?php

/**
 * Newsletters subscribers API Extension
 *
 * @category   Rapidmail
 * @package    Rapidmail_RMConnect
 */

class Rapidmail_RMConnect_Model_Newsletter_Api_V2 extends Mage_Api_Model_Resource_Abstract
{

    /**
     * Returns newsletter subscribers
     *
     * @return array
     */
    public function subscriberList()
    {

        $resource = Mage::getSingleton('core/resource');

        // Get subscribers
        $results = $resource->getConnection('core_read')->fetchAll('SELECT * FROM newsletter_subscriber');

        return (array)$results;

    }

    /**
     * Changes status of subscriber
     *
     * @return array
     */
    public function subscriberUpdateStatus($email, $status)
    {

        if (!in_array($status, array(Mage_Newsletter_Model_Subscriber::STATUS_SUBSCRIBED, Mage_Newsletter_Model_Subscriber::STATUS_NOT_ACTIVE, Mage_Newsletter_Model_Subscriber::STATUS_UNSUBSCRIBED, Mage_Newsletter_Model_Subscriber::STATUS_UNCONFIRMED))) {
            return 400;
        }

        $resource = Mage::getSingleton('core/resource');
        $db = $resource->getConnection('core_write');

        // Get subscriber
        $subscriber = $db->fetchRow('SELECT * FROM ' . $resource->getTableName('newsletter/subscriber') . ' WHERE subscriber_email = "' . $db->quote($email) . '" LIMIT 1');

        if (!$subscriber) {
            return 404;
        }

        // Update subscriber's status and change time
        $db->query('UPDATE ' . $resource->getTableName('newsletter/subscriber') . ' SET subscriber_status = ' . (int)$status . ', change_status_at = NOW() WHERE subscriber_email = ' . $db->quote($email) . ' LIMIT 1');

        return 200;

    }

}

?>
