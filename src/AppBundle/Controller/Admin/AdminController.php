<?php
namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/test", name="home_admin")
     */
    public function homeAction()
    {
        $x = 5;
        
        return $this->render(
            'AppBundle:admin:new_faculty.html.twig',
            ['x' => $x]
        );

    }
}
