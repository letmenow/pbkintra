<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
 * @ORM\Id
 * @ORM\Column(type="integer" , name="USER_ID")
 * @ORM\GeneratedValue(strategy="AUTO")
 */
protected $id;

public function getId() {
    return $this->id;
}

public function setId($id) {
    $this->id = $id;
    return $this;
}

public function __construct()
{
    parent::__construct();
     //do domething
}
}
