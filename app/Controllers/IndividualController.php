<?php

namespace App\Controllers;

use App\Models\Individual;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndividualController extends BaseController
{
    protected $request;
    protected $response;
    protected $em;

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
     * Login action
     * @return string
     */
    public function login()
    {
        try {
            $input = json_decode(
                $this->request->getContent(),
                true
            );

            /** @var Individual $user */
            $user = $this->em
                ->getRepository(Individual::class)
                ->findOneBy([
                    'username' => $input['username'],
                ]);

            if (!$user instanceof Individual) {
                throw new \Exception('Unauthorized');
            }

            if ($user->getPassword() !== md5($input['password'])) {
                throw new \Exception('Incorrect password');
            }

            $token = rand_str();
            $user->setAccessToken($token);
            $this->em->persist($user);
            $this->em->flush();

            return json_encode([
                'success' => true,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return $this->unsuccess($e->getMessage());
        }
    }

    /**
     * Check user token
     * @return string
     */
    public function check()
    {
        try {
            /** @var Individual $user */
            $user = $this->em
                ->getRepository(Individual::class)
                ->findOneBy([
                    'accessToken' => $this->request->query->get('token'),
                ]);

            return json_encode([
                'success' => $user instanceof Individual,
            ]);
        } catch (\Exception $e) {
            return $this->unsuccess($e->getMessage());
        }
    }
}