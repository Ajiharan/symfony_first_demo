<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
//    #[Route('/main', name: 'main')]
    public function index(): Response
    {
        return $this->render('/home/home.html.twig');
    }

    public function show():Response{
        return new Response(content:'<h2>Welcome to custom api</h2>');
    }

    public function display(Request $request):Response{
//        dump($request->get('name'));
        $name=$request->get('name');
        return $this->render('/home/display.html.twig',['name'=>$name]);
    }


}
