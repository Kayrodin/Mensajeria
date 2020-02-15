<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Group
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="Group")
 */
class Group
{

    /**
     * @var integer $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var integer $owner
     * @ORM\Column(type="integer")
     */
    private $owner_id;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="groups")
     * @ORM\JoinTable(name="Members_group")
     */
    private $users;

    /**
     * Group constructor.
     * @param int $id
     * @param string $name
     * @param string $owner
     * @param $users
     */
    public function __construct(string $name, string $owner)
    {
        $this->name = $name;
        $this->owner = $owner;
        $this->users = new ArrayCollection();
    }

    /*--------------------------------------------------------------------------------------------------------------------*/

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Group
     */
    public function setId(int $id): Group
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Group
     */
    public function setName(string $name): Group
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     * @return Group
     */
    public function setOwner(string $owner): Group
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }

    /**
     * @param ArrayCollection $users
     * @return Group
     */
    public function setUsers(ArrayCollection $users): Group
    {
        $this->users = $users;
        return $this;
    }


}