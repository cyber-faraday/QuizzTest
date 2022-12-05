<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        // Create 5 users
        $user = new User();
        $user->setEmail('admin@admin.com')
            ->setPassword($this->hasher->hashPassword($user, 'admin'))
            ->setPseudo('admin')
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $user1 = new User();
        $user1->setEmail('user@user.com')
            ->setPassword($this->hasher->hashPassword($user1, 'user'))
            ->setPseudo('user');
            
        $manager->persist($user1);


        $user2 = new User();
        $user2->setEmail('chris@chris.com')
            ->setPassword($this->hasher->hashPassword($user2, 'chris'))
            ->setPseudo('chris');
            
        $manager->persist($user2);
        
        
        $user3 = new User();
        $user3->setEmail('jerome@jerome.com')
            ->setPassword($this->hasher->hashPassword($user3, 'jerome'))
            ->setPseudo('jerome');
            
        $manager->persist($user3);
        
        
        $user4 = new User();
        $user4->setEmail('gilbert@gilbert.com')
            ->setPassword($this->hasher->hashPassword($user4, 'gilbert'))
            ->setPseudo('gilbert');
            
        $manager->persist($user4);


        $manager->flush();
    }
}
