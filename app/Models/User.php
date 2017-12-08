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
}