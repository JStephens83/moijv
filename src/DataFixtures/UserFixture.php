<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture{
    public function load(ObjectManager $manager) {
        //on crée un admin
        $admin = new User();
        $admin->setroles('ROLE_USER|ROLE_ADMIN');
        $admin->setUserName('root');
        $admin->setPassword(password_hash('root', PASSWORD_BCRYPT));
        $admin->setEmail('admin@gmail.com');
        $admin->setBirthdate(\DateTime::createFromFormat('Y/m/d h:i:s', '1988/05/24 00:00:00'));
        
        $manager->persist($admin);
        
        
        for ($i = 1; $i<=20; $i++){
            // On crée une liste factice de 20 users
            $user = new User();//on tape "user", et dans la liste on séléctionne app\entity puis ctrl+maj+i
            $user->setUsername('user' . $i);
            $user->setEmail('user' . $i . '@mail.com');
            $user->setFirstname('User' . $i);
            $user->setLastname('Fake');
            $user->setRoles('ROLE_USER');
            $user->setPassword(password_hash('user' . $i, PASSWORD_BCRYPT));
            $user->setBirthdate(\DateTime::createFromFormat('Y/m/d h:i:s', (2000 - $i).'/01/01 00:00:00'));
            
            //Notre user sera référéncé dans les autres Fixtures sous la clé user0 puis user1 puis user2,etc...
            $this->addReference('user'.$i, $user);
            
            // On demande au manger d'enregistrer le user en BDD
            $manager->persist($user);
        }
        
        
        $manager->flush();// Les INSERT INTO ne sont effectués qu'à partir de ce moment.
    }

}
