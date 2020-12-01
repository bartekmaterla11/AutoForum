<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

class PostReference
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="")
     */
    protected $id_user;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="")
     */
    protected $id_post;

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->id_post;
    }
}