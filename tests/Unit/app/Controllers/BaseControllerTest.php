<?php

namespace Tests\Unit\app\Controllers;

use Tests\Mocks\app\Controllers\BaseControllerMock;

/**
 * Class BaseControllerTest
 *
 * @package Tests\Unit\app\Controllers
 */
class BaseControllerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider unsuccessDataProvider
     * @param $message
     */
    public function testUnsuccess($message)
    {
        $controller = new BaseControllerMock();
        $actualResult = $controller->unsuccess($message);

        $this->assertSame(json_encode([
            'success' => false,
            'message' => $message,
        ]), $actualResult);
    }

    /**
     * Data provider for testUnsuccess method
     *
     * @return array
     */
    public function unsuccessDataProvider()
    {
        return [
            ['test1'], ['test2'], ['test3'], [false], [null],
        ];
    }
}
