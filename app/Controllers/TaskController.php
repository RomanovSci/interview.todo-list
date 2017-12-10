<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use Doctrine\ORM\EntityManager;
use Gregwar\Image\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends BaseController
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
            return $this->unsuccess($e->getMessage());
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
            $input = $this->request->request->all();
            $fileName = $this->saveFile(
                $this->request->files->get('taskImage')
            );

            $this->em->persist((new Task())
                ->setUsername($input['username'])
                ->setUserEmail($input['email'])
                ->setText($input['text'])
                ->setPicture($fileName)
                ->timestamps()
            );
            $this->em->flush();

            return json_encode([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return $this->unsuccess($e->getMessage());
        }
    }

    public function update()
    {
        try {
            $data = json_decode(
                $this->request->getContent(),
                true
            );

            $user = $this->em
                ->getRepository(User::class)
                ->findOneBy([
                    'accessToken' => $data['token'],
                ]);

            if (!$user instanceof User) {
                throw new \Exception('Unauthorized');
            }

            if (!$user->getIsAdmin()) {
                throw new \Exception('Permissions denied');
            }

            if (!is_array($data['tasks'])) {
                throw new \Exception('Incorrect format');
            }

            foreach ($data['tasks'] as $task) {
                /** @var Task $taskEntity */
                $taskEntity = $this->em
                    ->getRepository(Task::class)
                    ->find($task['id']);

                if (!$taskEntity instanceof Task) {
                    throw new \Exception("Couldn't find task ".$task['id']);
                }

                $taskEntity->setText($task['text']);
                $taskEntity->setCompletedAt($task['completed_at']
                    ? new \DateTime()
                    : nullg
                );

                $this->em->flush();
            }

            return json_encode(['success' => true]);
        } catch (\Exception $e) {
            return $this->unsuccess($e->getMessage());
        }
    }

    /**
     * @param $file
     * @return string
     */
    protected function saveFile($file)
    {
        try {
            if (!$file instanceof UploadedFile) {
                return null;
            }

            $fileName = rand_str(32).'.'.$file->getClientOriginalExtension();
            $file->move(__DIR__.'/../../public/images/uploaded', $fileName);
            $img = Image::open(__DIR__.'/../../public/images/uploaded/'.$fileName);

            if ($img->width() > 320 || $img->height() > 240) {
                $img->forceResize(320, 240)->save(__DIR__.'/../../public/images/uploaded/'.$fileName);
            }

            return $fileName;
        } catch (\Exception $e) {
            return null;
        }
    }
}