<?php
namespace User\Entity;

use BjyAuthorize\Provider\Role\ProviderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface, ProviderInterface {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", unique=true,  length=255)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $displayName;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $state;

    /**
     * @ORM\ManyToMany(targetEntity="MyNamespace\Role")
     * @ORM\JoinTable(name="user_role_linker",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected $roleList;

    /**
     * @ORM\OneToMany(targetEntity="Feature", mappedBy="product")
     **/
    private $borrowedList;

    public function __construct() {
        $this->roleList = new ArrayCollection();
        $this->borrowedList = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getRoleList() {
        return $this->roleList->getValues();
    }

    public function addRole(Role $role) {
        $this->roleList->add($role);
    }

    public function removeRole(Role $role) {
        $this->roleList->removeElement($role);
    }
}
