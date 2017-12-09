<?php

require __DIR__.'/../vendor/autoload.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__.'/../core/db.php';

echo 'Creating administrator entity'.PHP_EOL;

echo 'Please input admin username: ';
$username = fgets(fopen("php://stdin","r"));

echo 'Please create password: ';
$password = fgets(fopen("php://stdin","r"));

echo 'Confirm password: ';
$passwordConfirm = fgets(fopen("php://stdin","r"));

if ($password !== $passwordConfirm) {
    echo "Passwords doesn't match".PHP_EOL;
    exit;
}

try {
    $user = new App\Models\User();
    $user
        ->setUsername(trim($username))
        ->setPassword(trim($password))
        ->setIsAdmin(true)
        ->timestamp();

    $em->persist($user);
    $em->flush();
} catch (\Exception $e) {

    echo 'Error!'
        .PHP_EOL
        .$e->getMessage()
        .PHP_EOL;
}

echo 'Done';

