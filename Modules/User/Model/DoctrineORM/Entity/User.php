<?php

namespace Modules\User\Model\DoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ACL\Roles\HasRoles;
use Gedmo\Mapping\Annotation as Gedmo;
use LaravelDoctrine\ACL\Mappings as ACL;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRolesContract;
use Modules\User\Model\DoctrineORM\UserInterface;

/**
 * @ORM\Entity(repositoryClass="Modules\User\Model\DoctrineORM\Repository\UserRepository")
 * @ORM\Table(name="users") 
 * @ORM\HasLifecycleCallbacks()
 */
class User implements HasRolesContract, UserInterface, \LaravelDoctrine\ORM\Contracts\Auth\Authenticatable
{

    use \LaravelDoctrine\ORM\Auth\Authenticatable,
        HasRoles,
        Timestamps;

    /**
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="username", type="string")
     */
    protected $username;

    /**
     * @ORM\Column(name="email", unique=true, type="string")
     */
    protected $email;

    /**
     * @ORM\Column(name="confirmed", type="boolean", nullable=true )
     */
    protected $confirmed = '0';

    /**
     * @ORM\Column(name="confirmation_code", type="string", nullable=true)
     */
    protected $confirmationCode;

    /**
     * @ORM\Column(name="first_name", type="string")
     */
    protected $firstName;

    /**
     * @ORM\Column(name="last_name", type="string")
     */
    protected $lastName;

    /**
     * @ORM\Column(name="address", type="string", nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(name="city", type="string", nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(name="country", type="string", nullable=true)
     */
    protected $country;

    /**
     * @ORM\Column(name="zip_code", type="integer", nullable=true)
     */
    protected $zipCode;

    /**
     * @ORM\Column(name="phone", type="integer", nullable=true)
     */
    protected $phone;

    /**
     * @ACL\HasRoles()
     * @var \Doctrine\Common\Collections\ArrayCollection|\LaravelDoctrine\ACL\Contracts\Role[]
     */
    protected $roles;

    public function getRoles()
    {
        return $this->roles;
    }

   
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberTokenName()
    {
        return $this->rememberToken;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    function getId()
    {
        return $this->id;
    }

    function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getConfirmed()
    {
        return $this->confirmed;
    }

    function getConfirmationCode()
    {
        return $this->confirmationCode;
    }

    function getFirstName()
    {
        return $this->firstName;
    }

    function getLastName()
    {
        return $this->lastName;
    }

    function getAddress()
    {
        return $this->address;
    }

    function getCity()
    {
        return $this->city;
    }

    function getCountry()
    {
        return $this->country;
    }

    function getZipCode()
    {
        return $this->zipCode;
    }

    function getPhone()
    {
        return $this->phone;
    }

    public function getRememberToken()
    {
        $this->rememberToken;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRememberToken($rememberToken)
    {
        $this->rememberToken = $rememberToken;
    }

    function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    function setConfirmationCode($confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
    }

    function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    function setAddress($address)
    {
        $this->address = $address;
    }

    function setCity($city)
    {
        $this->city = $city;
    }

    function setCountry($country)
    {
        $this->country = $country;
    }

    function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    public function getNameOrUsername() {
        return ($this->firstName && $this->lastName) ? $this->getFullName() : $this->username;
    }
    
    public function getFullName()
    {
        return ($this->firstName && $this->lastName) ? $this->firstName . ' ' . $this->lastName : $this->username;
    }
    
    public function getAvatarUrl($size = 200)
    {
        return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm&s=' . $size;
    }
    

}
