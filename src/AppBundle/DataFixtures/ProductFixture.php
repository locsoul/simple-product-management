<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = $this->getReference(CategoryFixture::CATEGORY_REFERENCE);

        // create 5 products
        for ($i = 1; $i <= 5; $i++) {
            $product = new Product();
            $product->setName("Product " . $i);
            $product->setPrice(mt_rand(10, 100));
            $product->addCategory($category);
            $manager->persist($product);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CategoryFixture::class,
        );
    }
}
