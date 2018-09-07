<?php

namespace Tests\Unit\app\Controllers;

use Tests\Mocks\app\Controllers\SiteControllerMock;
use PHPUnit\Framework\TestCase;

/**
 * Class SiteControllerTest
 *
 * @package Tests\Unit\app\Controllers
 */
class SiteControllerTest extends TestCase
{
    public function testConstruct()
    {
        /** @var \Twig_Environment $twig */
        $twig = $this->getMockBuilder(\Twig_Environment::class)
            ->disableOriginalConstructor()
            ->setMethods()
            ->getMock();

        $controller = new SiteControllerMock($twig);
        $this->assertInstanceOf(\Twig_Environment::class, $controller->twig);
    }

    /**
     * @dataProvider indexDataProvider
     * @param $renderResult
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testIndex($renderResult)
    {
        /** @var \Twig_Environment $twig */
        $twig = $this->getMockBuilder(\Twig_Environment::class)
            ->disableOriginalConstructor()
            ->setMethods(['render'])
            ->getMock();

        $twig->expects($this->once())
            ->method('render')
            ->willReturn($renderResult);

        $controller = new SiteControllerMock($twig);
        $actualResult = $controller->index();

        $this->assertSame($renderResult, $actualResult);
    }

    /**
     * Data provider for testIndex method
     *
     * @return array
     */
    public function indexDataProvider()
    {
        return [
            ['test1'], ['test2'], ['test3'],
        ];
    }
}
