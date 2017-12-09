<?php

namespace App\Controllers;

use App\Models\Task;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController
{
    protected $request;
    protected $response;
    protected $em;

    /**
     * TaskController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param EntityManager $em
     */
    public function __construct(
        Request $request,
        Response $response,
        EntityManager $em
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->em = $em;
    }

    /**
     * Get task list
     *
     * @return string
     */
    public function index()
    {
        try {
            $tasks = $this->em
                ->getRepository(Task::class)
                ->findAll();
            $data = [];

            if (!is_array($tasks)) {
                throw new \Exception("Can't getting task list");
            }

            foreach ($tasks as $task) {
                array_push($data, $task->asArray());
            }

            return json_encode([
                'success' => true,
                'tasks' => $data,
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'success' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Create task
     *
     * @return string
     */
    public function create()
    {
        try {
            $input = json_decode(
                $this->request->getContent(),
                true
            );

            $this->em->persist((new Task())
                ->setUsername($input['username'])
                ->setUserEmail($input['email'])
                ->setText($input['text'])
                ->setPicture('Some path')
                ->timestamps()
            );
            $this->em->flush();

            return json_encode([
                'success' => true,
            ]);
        } catch (\Exception $e) {

            return json_encode([
                'success' => false,
            ]);
        }
    }
}