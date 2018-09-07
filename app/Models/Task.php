<?php

namespace App\Models;

/**
 * @Entity
 * @Table(name="task")
 */
class Task
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string")
     */
    protected $username;

    /**
     * @Column(
     *     type="string",
     *     name="user_email"
     * )
     */
    protected $userEmail;

    /**
     * @Column(type="string")
     */
    protected $text;

    /**
     * @Column(
     *     type="string",
     *     nullable=true
     * )
     */
    protected $picture;

    /**
     * @Column(
     *     type="datetime",
     *     name="completed_at",
     *     nullable=true
     * )
     */
    protected $completedAt;

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
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param string $userEmail
     * @return $this
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return $this
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * @param \DateTime $completedAt
     * @return $this
     */
    public function setCompletedAt($completedAt)
    {
        $this->completedAt = $completedAt;
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
    public function timestamps()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        return $this;
    }

    /**
     * Return task data
     *
     * @return array
     */
    public function asArray()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->userEmail,
            'text' => $this->text,
            'pic' => $this->picture,
            'completed_at' => $this->completedAt,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
