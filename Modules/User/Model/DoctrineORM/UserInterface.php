<?php

namespace Modules\User\Model\DoctrineORM;

interface UserInterface
{

    public function getId();

    public function setId($id);

    public function getUsername();

    public function setUsername($username);

    public function getEmail();

    public function setEmail($email);

    public function getPassword();

    public function setPassword($password);

    public function getConfirmed();

    public function setConfirmed($confirmed);

    public function getConfirmationCode();

    public function setConfirmationCode($confirmationCode);

    public function getFirstName();

    public function setFirstName($firstName);

    public function getLastName();

    public function setLastName($lastName);

    public function getPhone();

    public function setPhone($phone);

    public function getAddress();

    public function setAddress($address);

    public function getCity();

    public function setCity($city);

    public function getCountry();

    public function setCountry($country);

    public function getZipCode();

    public function setZipCode($zipCode);
   
   
}
