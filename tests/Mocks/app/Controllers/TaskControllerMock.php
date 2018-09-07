<?php

namespace Tests\Mocks\app\Controllers;

use App\Controllers\TaskController;

/**
 * Class TaskControllerMock
 *
 * @package Tests\Mocks\app\Controllers
 */
class TaskControllerMock extends TaskController
{
    public $request;
    public $response;
    public $em;
}
