<?php


namespace App\Controller\Main;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    public function renderDefault()
    {
        return [
            'title' => 'Learning Website'
        ];
    }
}