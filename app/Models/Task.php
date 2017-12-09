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
     * @Column(type="string")
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

    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getUserEmail() { return $this->userEmail; }
    public function getText() { return $this->text; }
    public function getPicture() { return $this->picture; }
    public function getCompletedAt() { return $this->completedAt; }
    public function getCreatedAt() { return $this->createdAt; }
    public function getUpdatedAt() { return $this->updatedAt; }

    public function setUsername($username) { $this->username = $username; }
    public function setUserEmail($userEmail) { $this->userEmail = $userEmail; }
    public function setText($text) { $this->text = $text; }
    public function setPicture($picture) { $this->picture = $picture; }
    public function setCompletedAt($completedAt) { $this->completedAt = $completedAt; }
    public function timestamps()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Return task data
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