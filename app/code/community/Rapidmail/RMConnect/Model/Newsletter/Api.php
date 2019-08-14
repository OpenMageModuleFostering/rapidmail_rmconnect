<?php

/**
 * Newsletters subscribers API Extension
 *
 * @category   Rapidmail
 * @package    Rapidmail_RMConnect
 */

class Rapidmail_RMConnect_Model_Newsletter_Api extends Mage_Api_Model_Resource_Abstract {

    /**
     * Returns newsletter subscribers
     *
     * @return array
     */
    public function subscriberList() {

        return Mage::getModel('newsletter/subscriber')
            ->getCollection()
            ->addFieldToSelect('*');

    }

    /**
     * Changes status of subscriber
     *
     * @param string $email
     * @param int $status
     * @return array
     */
    public function subscriberUpdateStatus($email, $status) {

        $subscriber = Mage::getModel('newsletter/subscriber')
            ->loadByEmail($email);

        if (!$subscriber->getId()) {
            $this->_fault('subscriber_not_exists');
        }


        if (!in_array($status, array(Mage_Newsletter_Model_Subscriber::STATUS_SUBSCRIBED, Mage_Newsletter_Model_Subscriber::STATUS_NOT_ACTIVE, Mage_Newsletter_Model_Subscriber::STATUS_UNSUBSCRIBED, Mage_Newsletter_Model_Subscriber::STATUS_UNCONFIRMED))) {
            $this->_fault('subscriber_invalid_status');
        }

        try {
            $subscriber->setStatus($status)
                ->save();
        } catch (Exception $e) {
            $this->_fault('status_save_failed', $e->getMessage());
        }
    }
}
