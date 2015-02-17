<?php

namespace Kwejk\MemsBundle\Controller;

use Kwejk\MemsBundle\Form\CommentType;
use Kwejk\MemsBundle\Form\AddCommentType;
use Kwejk\MemsBundle\Entity\Comment;
use Kwejk\MemsBundle\Form\AddMemType;
use Kwejk\MemsBundle\Entity\Mem;
use Symfony\Component\HttpFoundation\Request;
use Kwejk\CoreBundle\Controller\Controller;
use Kwejk\MemsBundle\Entity\Rating;
use Kwejk\MemsBundle\Form\AddRatingType;
use Kwejk\MemsBundle\Entity\RatingRepository;

class MemsController extends Controller
{
    public function listAction($page)
    {
        $mems = $this->getDoctrine()
            ->getRepository('KwejkMemsBundle:Mem')
            ->findBy(
                ['isAccepted' => true],
                ['createdAt' => 'desc']
            );
            
        $paginator  = $this->get('knp_paginator');
        $pages = $paginator->paginate(
            $mems,
            $page,
            5
        );
        
        return $this->render('KwejkMemsBundle:Mems:list.html.twig', array(
            'pages' => $pages,
        ));
    }

    public function listUnacceptedAction($page)
    {
        $mems = $this->getDoctrine()
                ->getRepository('KwejkMemsBundle:Mem')
                 ->findBy(
                ['isAccepted' => false],
                ['createdAt' => 'desc']
            );
         $paginator  = $this->get('knp_paginator');
         $pages = $paginator->paginate(
                $mems,
                $page,
                5
        );
        return $this->render('KwejkMemsBundle:Mems:listUnaccepted.html.twig', array(
            'pages' =>$pages,
        ));
        
    }
    
    public function showAction($slug)
    {
        $request = $this->getRequest();
        $user = $this->getUser();
        
        $mem = $this->getDoctrine()
            ->getRepository('KwejkMemsBundle:Mem')
            ->findOneBy([
                'slug'          => $slug
            ]);
         
        if (!$mem) {
            throw $this->createNotFoundException('Mem nie istnieje');
        }
        
        $comment = new Comment();
        $form = $this->createForm(new AddCommentType(), $comment);
        
        if ($user && $user->hasRole('ROLE_USER')) {

            $comment->setMem($mem);
            $comment->setCreatedBy($user);
            // TODO: homework
            // $comment->setHost($host);
            // ...
            
            $form1->handleRequest($request);
            
            if ($form1->isValid()) {
            
                // save data
                $this->persist($comment);
            
                $this->addFlash('notice', "Komentarz został pomyślnie zapisany.");
            
                return $this->redirect($this->generateUrl('kwejk_mems_show', array(
                    'slug' => $mem->getSlug())
                ));
            }
        }
        
     $rating = new Rating();
        $form2 = $this->createForm(new AddRatingType(), $rating);
        $rating->setMem($mem);
        $rating->setCreatedBy($user);
        $form2->handleRequest($request);
            
       
        if ($form2->isValid()) {
             
                // save data
                $this->persist($rating);
            
                $this->addFlash('notice', "Ocena została pomyślnie zapisana.");
            
                return $this->redirect($this->generateUrl('kwejk_mems_show', array(
                    'slug' => $mem->getSlug())
                ));
            }
         $avgRating = $this->getDoctrine()
            ->getRepository('KwejkMemsBundle:Mem')
            ->getMemAvgRating($mem);
        $averageRating=$avgRating['avgRating'];
        
        return $this->render('KwejkMemsBundle:Mems:show.html.twig', array(
            'mem' => $mem,
            'form1' => $form1->createView(),
            'averageRating' => $averageRating,
            'form2' => $form2->createView()
        ));    
        
    }
    
    public function showRandomAction()
    {
        $request = $this->getRequest();
        $user = $this->getUser();
        $mem = $this->getDoctrine()
            ->getRepository('KwejkMemsBundle:Mem')
            ->getRandom();
        
        
        $comment = new Comment();
        $form1 = $this->createForm(new AddCommentType(), $comment);
         if ($user && $user->hasRole('ROLE_USER')) {
            
            $comment->setHost();
            $comment->setIp();
            $comment->setUserAgent();
            $comment->setMem($mem);
            $comment->setCreatedBy($user);
            
            $form1->handleRequest($request);
            
            if ($form1->isValid()) {
             
                // save data
                $this->persist($comment);
            
                $this->addFlash('notice', "Komentarz został pomyślnie zapisany.");
            
                return $this->redirect($this->generateUrl('kwejk_mems_show', array(
                    'slug' => $mem->getSlug())
                ));
            }
        }
        $rating = new Rating();
        $form2 = $this->createForm(new AddRatingType(), $rating);
        $rating->setMem($mem);
        $rating->setCreatedBy($user);
        $form2->handleRequest($request);
        
       
        
        
        if ($form2->isValid()) {
             
                // save data
                $this->persist($rating);
            
                $this->addFlash('notice', "Ocena została pomyślnie zapisana.");
            
                return $this->redirect($this->generateUrl('kwejk_mems_show', array(
                    'slug' => $mem->getSlug())
                ));
            }
        $avgRating = $this->getDoctrine()
            ->getRepository('KwejkMemsBundle:Mem')
            ->getMemAvgRating($mem);
        $averageRating=$avgRating['avgRating'];
        
        return $this->render('KwejkMemsBundle:Mems:show.html.twig', array(
            'mem' => $mem,
            'form1' => $form1->createView(),
            'averageRating' => $averageRating,
            'form2' => $form2->createView()
        ));
    }
    
    public function addAction(Request $request)
    {
        $user = $this->getUser();
        
        if (!$user || !$user->hasRole('ROLE_USER')) {
            throw $this->createAccessDeniedException("Nie posiadasz odpowiednich uprawnień!");
        }
        
        $mem = new Mem();
        $mem->setCreatedBy($user);
        
        $form = $this->createForm(new AddMemType(), $mem);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            // save data
            $this->persist($mem);
            
            $this->addFlash('notice', "Mem został pomyślnie dodane i oczekuje w poczekalni.");
            
            return $this->redirect($this->generateUrl('kwejk_mems_list'));
        }
        
        
        return $this->render('KwejkMemsBundle:Mems:add.html.twig', array(
            'form'  => $form->createView()
        ));
    }

}
