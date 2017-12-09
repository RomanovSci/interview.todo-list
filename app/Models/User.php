<?php

namespace App\Models;

/**
 * @Entity
 * @Table(name="user")
 */
class User
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $username;

    /**
     * @Column(type="string")
     */
    private $password;

    /**
     * @Column(
     *     type="boolean",
     *     name="is_admin",
     *     options={
     *          "default": 0
     *     }
     * )
     */
    private $isAdmin;

    /**
     * @Column(
     *     type="datetime",
     *     name="created_at",
     *     options={
     *          "default": "CURRENT_TIMESTAMP"
     *     }
     * )
     */
    private $createdAt;

    /**
     * @Column(
     *     type="datetime",
     *     name="updated_at",
     *     options={
     *          "default": "CURRENT_TIMESTAMP"
     *     }
     * )
     */
    private $updatedAt;

    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getIsAdmin() { return $this->isAdmin; }
    public function getCreatedAt() { return $this->createdAt; }
    public function getUpdatedAt() { return $this->updatedAt; }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password) {
        $this->password = md5($password);
        return $this;
    }

    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    public function timestamp()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        return $this;
    }
}