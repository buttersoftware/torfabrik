<?php

/**
 * Description of BookingModel
 *
 * @author Pspiess
 */

namespace pspiess\LetsplayBundle\Service;

use pspiess\LetsplayBundle\Entity\Booking;

/**
 * Service to persist Booking Data
 */
class BookingModel {
    
    private $EntityManager;
    public function __construct($EntityManager) {
        $this->EntityManager = $EntityManager;
    }

    /**
     * Get BookingModel service *
     * @return \pspiess\LetsplayBundle\Service\BookingModel
     */
    public function addReservation($data) {
        $sSerial = $this->GetSerialOption($data['serial']);
        $dSerialDate = new \DateTime($data['serial_date']);
        $dStartDate = new \DateTime($data['start']);
        $dEndDate = new \DateTime($data['end']);

        $customer = $this->EntityManager->getRepository('pspiessLetsplayBundle:Customer')->find($data["customerid"]);
        $field = $this->EntityManager->getRepository('pspiessLetsplayBundle:Field')->find($data["fieldid"]);

        for ($dDate = $dStartDate; $dDate < $dSerialDate; $dDate->modify($sSerial)) {
            $booking = new Booking();

            $booking->setCustomer($customer);
            $booking->setField($field);
            $booking->setTitle($data["title"]);
            $booking->setStart($dStartDate);
            $booking->setEnd($dEndDate);
            
            $this->EntityManager->persist($booking);
            $this->EntityManager->flush();
            
            $dEndDate->modify($sSerial);
        }

        return $booking;
    }

    private function GetSerialOption($data) {
        switch ($data) {
            case 0:
                $sSerial = '+1 day';
                break;
            case 1:
                $sSerial = '+7 day';
                break;
            case 2:
                $sSerial = '+14 day';
                break;
            case 3:
                $sSerial = '+1 month';
                break;
        }
        return $sSerial;
    }

}