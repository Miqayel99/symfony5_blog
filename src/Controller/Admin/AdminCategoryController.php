<?php


namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AdminBaseController
{

    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function index()
    {
        $category = $this->getDoctrine()->getRepository(Category::class)
            ->findAll();

        $forRender= parent::renderDefault();
        $forRender['title'] = 'Categories';
        $forRender['category'] = $category;
        return $this->render('admin/category/index.html.twig',$forRender);
    }

    /**
     * @Route("/admin/category/create", name="admin_category_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
            $category->setCreatedAtValue();
            $category->setUpdatedAtValue();
            $category->setIsPublished();
            $em->persist($category);
            $em->flush();
            $this->addFlash('success','Category created');
            return $this->redirectToRoute('admin_category');
        }
        $forRender= parent::renderDefault();
        $forRender['title'] = 'Category creation';
        $forRender['form'] = $form->createView();
        return $this->render('admin/category/form.html.twig', $forRender);
    }

    /**
     * @Route("/admin/category/update/{id}", name="admin_category_update")
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function update(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $this->getDoctrine()->getRepository(Category::class)
            ->find($id);
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
            if ($form->get('save')->isClicked()){
                $category->setUpdatedAtValue();
                $this->addFlash('success','Category updated');
            }
            if($form->get('delete')->isClicked()){
                $em->remove($category);
                $this->addFlash('success','Category deleted');
            }
            $em->flush();
            return $this->redirectToRoute('admin_category');
        }

        $forRender= parent::renderDefault();
        $forRender['title'] = 'Category updating';
        $forRender['form'] = $form->createView();
        return $this->render('admin/category/form.html.twig', $forRender);
    }

}