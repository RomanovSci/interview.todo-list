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
    private $id;

    /**
     * @Column(type="string")
     */
    private $username;

    /**
     * @Column(
     *     type="string",
     *     name="user_email"
     * )
     */
    private $userEmail;

    /**
     * @Column(type="string")
     */
    private $text;

    /**
     * @Column(type="string")
     */
    private $picture;

    /**
     * @Column(
     *     type="datetime",
     *     name="completed_at",
     *     nullable=true
     * )
     */
    private $completedAt;

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
}