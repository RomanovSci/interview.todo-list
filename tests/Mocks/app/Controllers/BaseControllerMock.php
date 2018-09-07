<?php

namespace Tests\Mocks\app\Controllers;

use App\Controllers\BaseController;

/**
 * Class BaseControllerMock
 *
 * @package Tests\Mocks\app\Controllers
 */
class BaseControllerMock extends BaseController
{
    public function unsuccess($message = '')
    {
        return parent::unsuccess($message);
    }
}
