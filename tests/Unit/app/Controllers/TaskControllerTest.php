<?php

namespace Tests\Unit\app\Controllers;

use App\Controllers\TaskController;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

class TaskControllerMock extends TaskController
{
    public $request;
    public $response;
    public $em;
}