<?php
namespace User\Entity;

use BjyAuthorize\Acl\HierarchicalRoleInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 */
class Role implements HierarchicalRoleInterface {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $roleId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $isDefault;

    /**
     * @var Role
     * @ORM\ManyToOne(targetEntity="User\Entity\Role")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $parent;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = (int)$id;
    }

    public function getRoleId() {
        return $this->roleId;
    }

    public function setRoleId($roleId) {
        $this->roleId = (string) $roleId;
    }

    public function getIsDefault() {
        return $this->isDefault;
    }

    public function setIsDefault($isDefault) {
        $this->isDefault = $isDefault;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setParent(Role $parent) {
        $this->parent = $parent;
    }
}
