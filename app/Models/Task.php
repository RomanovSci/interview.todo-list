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
}