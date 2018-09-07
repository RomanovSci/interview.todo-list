<?php

namespace App\Models;

/**
 * @Entity
 * @Table(name="individual")
 */
class Individual
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(
     *     type="string",
     *     unique=true
     * )
     */
    protected $username;

    /**
     * @Column(type="string")
     */
    protected $password;

    /**
     * @Column(
     *     type="boolean",
     *     name="is_admin",
     *     options={
     *          "default": 0
     *     }
     * )
     */
    protected $isAdmin;

    /**
     * @Column(
     *      type="string",
     *      name="access_token",
     *      nullable=true
     * )
     */
    protected $accessToken;

    /**
     * @Column(
     *     type="datetime",
     *     name="created_at",
     *     options={
     *          "default": "CURRENT_TIMESTAMP"
     *     }
     * )
     */
    protected $createdAt;

    /**
     * @Column(
     *     type="datetime",
     *     name="updated_at",
     *     options={
     *          "default": "CURRENT_TIMESTAMP"
     *     }
     * )
     */
    protected $updatedAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param bool $isAdmin
     * @return $this
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setAccessToken($token)
    {
        $this->accessToken = $token;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return $this
     */
    public function timestamp()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        return $this;
    }
}
