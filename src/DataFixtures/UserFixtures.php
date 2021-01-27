<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('Paul');
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$a0hVTFZjL3NleFBYdlZQSQ$rcwhE2/Dp7U91gke52B/M+amkZK9x3sFn24ogC3gjt4');

        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword('$argon2id$v=19$m=65536,t=4,p=1$cmRWNVpNVmJVcUhLcFdRMQ$l+pBqgvLjqUOF7/EzrpRugW9eILZ8PI/XYZAKv2DqpE');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);


        $manager->flush();
    }
}
