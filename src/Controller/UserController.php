<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    public function index(UserRepository $repo): Response
    {
        $users=$repo->findAll();
        return $this->json(['users'=>$users]);

    }

    public function createUser(Request $request,ManagerRegistry $doctrine):Response{
        $payload=json_decode($request->getContent(),false);

        $em=$doctrine->getManager();
        $user=new User();
        $user->setName($payload->name)->setAddress($payload->address)->setAge($payload->age);
        $em->persist($user);
        $em->flush();
        return $this->json($payload);
    }

    public function deleteUser(ManagerRegistry $doctrine,Request $request,UserRepository $userRep):Response{
        $em=$doctrine->getManager();
        $user=$userRep->find($request->get('id'));
        $em->remove($user);
        $em->flush();
        return $this->json('user deleted sucessfully');
    }

//    public function updateUser(ManagerRegistry $dc,Request $req,UserRepository $userRep):Response{
//        $age=$req->get('age');
//        $em=$dc->getManager();
//        $user=$userRep->find($req->get('id'));
//        $user->setAge($age);
//        $em->persist($user);
//    }
}
