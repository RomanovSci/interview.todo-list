<?php

namespace Tests\Unit\app\Controllers;

use Doctrine\ORM\EntityManager;
use Tests\Mocks\app\Controllers\TaskControllerMock;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TaskControllerTest
 *
 * @package Tests\Unit\app\Controllers
 */
class TaskControllerTest extends TestCase
{
    public function testConstruct()
    {
        /** @var Request $request */
        $request = $this->getMockBuilder(Request::class)
            ->setMethods()
            ->getMock();

        /** @var Response $response */
        $response = $this->getMockBuilder(Response::class)
            ->setMethods()
            ->getMock();

        /** @var EntityManager $em */
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods()
            ->getMock();

        $controller = new TaskControllerMock(
            $request,
            $response,
            $em
        );

        $this->assertInstanceOf(Request::class, $controller->request);
        $this->assertInstanceOf(Response::class, $controller->response);
        $this->assertInstanceOf(EntityManager::class, $controller->em);
    }
}
