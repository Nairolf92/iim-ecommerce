<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i=0;$i<10;$i++) {
            $product = new Product();
            $product->setName('Product'. $i);
            $product->setPrice(rand(10, 50));
            $product->setSku('Product-'. $i);
            $product->setDescription('Description produit'. $i);

            $manager->persist($product);
        }

        $user = new User();
        $user->setEmail("f.kelnerowski@gmail.com");
        $user->setRoles([
            'ROLE_ADMIN'
        ]);
        $user->setPassword($this->encoder->encodePassword($user, "toto"));

        $manager->persist($user);

        $manager->flush();
    }
}
