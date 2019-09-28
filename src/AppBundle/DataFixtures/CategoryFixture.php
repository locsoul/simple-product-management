<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    const CATEGORY_REFERENCE = 'CATEGORIES_REF';

    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("Category name");
        $this->addReference(self::CATEGORY_REFERENCE, $category);

        $manager->persist($category);
        $manager->flush();
    }
}