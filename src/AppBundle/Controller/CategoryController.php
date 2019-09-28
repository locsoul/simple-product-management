<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractFOSRestController implements ClassResourceInterface {


    /**
     * Fetch a category by Id
     *
     * @Annotations\View(statusCode=Response::HTTP_OK)
     *
     * @param Category $category
     * @return mixed
     */
    public function getAction(Category $category) {
        return $category;
    }

    /**
     * Get all available categories
     *
     * @Annotations\View(statusCode=Response::HTTP_OK)
     *
     * @param Request $request
     * @return mixed
     */
    public function cgetAction(Request $request) {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();

        return $categories;
    }

    /**
     * Add a new category
     *
     * @Annotations\View()
     *
     * @SWG\Parameter(name="form", in="body", @Model(type=AppBundle\Form\CategoryType::class))
     * @SWG\Response(
     *     response=201,
     *     description="Category created"
     * )
     *
     * @param Request $request
     * @return mixed
     */
    public function postAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return View::create($category, Response::HTTP_CREATED);
        }

        return $form;
    }
}
