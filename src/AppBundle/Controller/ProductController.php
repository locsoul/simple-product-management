<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractFOSRestController implements ClassResourceInterface
{

    /**
     * Get a product by Id
     *
     * @Annotations\View()
     *
     * @param Product $product
     * @return Product
     */
    public function getAction(Product $product)
    {
        return $product;
    }

    /**
     * Get all products
     *
     * @Annotations\View()
     *
     * @param Request $request
     * @return object[]
     */
    public function cgetAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $repository->findAll();

        return $products;
    }

    /**
     * Add a new product
     *
     * @Annotations\View()
     *
     * @SWG\Parameter(name="form", in="body", @Model(type=AppBundle\Form\ProductType::class))
     * @SWG\Response(
     *     response=201,
     *     description="Product created"
     * )
     *
     * @param Request $request
     * @return mixed
     */
    public function postAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return View::create($product, Response::HTTP_CREATED);
        }

        return View::create($form, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update a product
     *
     * @Annotations\View()
     *
     * @SWG\Parameter(name="form", in="body", @Model(type=AppBundle\Form\ProductType::class))
     * @SWG\Response(
     *     response=200,
     *     description="Product updated"
     * )
     *
     * @param Request $request
     * @param Product $product
     * @return View
     * @throws \Exception
     */
    public function putAction(Request $request, Product $product)
    {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(ProductType::class, $product);
        $form->submit($data);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $product->setUpdatedAt(new \DateTime("now"));
            $em->persist($product);
            $em->flush();
            return View::create($product, Response::HTTP_OK);
        }

        return View::create($form, Response::HTTP_OK);
    }

    /**
     * Delete a product
     *
     * @Annotations\View()
     *
     * @param Product $product
     */
    public function deleteAction(Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        View::create(null, Response::HTTP_NO_CONTENT);
    }
}
