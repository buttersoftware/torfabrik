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
     * This service add a reservation to the database
     * @return \pspiess\LetsplayBundle\Service\BookingModel
     */
    public function addReservation($data) {
        $sSerial = $this->GetSerialOption($data['serial']);
        $dStartDate = new \DateTime($data['start']);
        $dEndDate = new \DateTime($data['end']);

        if ($data['serial_date'] == '0' || $data['serial_date'] == '') {
            $dSerialDate = new \DateTime($dStartDate->format('Y-m-d'));
        } else {
            $dSerialDate = new \DateTime($data['serial_date']);
        }

        $customer = $this->EntityManager->getRepository('pspiessLetsplayBundle:Customer')->find($data["customerid"]);
        $field = $this->EntityManager->getRepository('pspiessLetsplayBundle:Field')->find($data["fieldid"]);
        $category = $this->EntityManager->getRepository('pspiessLetsplayBundle:Category')->find($data["categoryid"]);

        for ($dDate = $dStartDate; $dDate->format('Y-m-d') <= $dSerialDate->format('Y-m-d'); $dDate->modify($sSerial)) {
            $booking = new Booking();

            $booking->setCustomer($customer);
            $booking->setField($field);
            $booking->setTitle($data["title"]);
            $booking->setCategory($category);
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
