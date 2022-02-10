<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    public function index(PostRepository $postRepo): Response
    {
        $posts=$postRepo->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }


    public function create(ManagerRegistry $doctrine,Request $request):Response{

        $entityManager=$doctrine->getManager();
        $post=new Post();
        $post->setTitle('Hi welcome to ORM ENTITY mapping');

        $entityManager->persist($post);
        $entityManager->flush();

        //entity manager

        return $this->json(['message'=>'data inserted sucessfully']);

    }


    public function viewOne(Request $request,PostRepository $postRepo):Response{
        $id=$request->get('id');
        $post=$postRepo->find($id);

        return $this->render('/post/singlepost.html.twig',['post'=>$post]);
    }

    public function deletePost(ManagerRegistry $doctrine,Request $request,PostRepository $postRepository):Response {
        $entityManager=$doctrine->getManager();
        $obj=$postRepository->find($request->get('id'));

        $entityManager->remove($obj);
        $entityManager->flush();
        $posts=$postRepository->findAll();
        return  $this->render('post/index.html.twig',['posts'=>$posts]);

    }


}
