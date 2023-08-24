<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Faker\Factory;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    private function truncate()
    {

        $this->connection->executeQuery('SET foreign_key_checks = 0');

        $this->connection->executeQuery('TRUNCATE TABLE review');

        $this->connection->executeQuery('SET foreign_key_checks = 1');
    }
    public function load(ObjectManager $manager): void
    {
        $this->truncate();

        $faker =Factory::create();

        $reviewsList = [];

            $reviews = new Review();

            $reviews->setRate($faker->randomFloat(1, 1, 5));
    
            $reviewsList[] = $reviews;

            $manager->persist($reviews);

        $manager->flush();
    }
}
