<?php
namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\FacultyType;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\Course;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\GeneralService;
use AppBundle\Form\CourseType;

class AdminController extends Controller
{
    /**
     * @Route("/new_faculty", name="new_faculty")
     */
    public function newFacultyAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $faculty = new Faculty();
        $facultyForm = $this->createForm(new FacultyType(), $faculty);
        $facultyForm->handleRequest($request);
        if ($facultyForm->isValid()) {

            if ($facultyForm->get('insert')->isClicked()) {
                
                $facultyForm = $facultyForm->getData();
                $facultyName = $facultyForm->getFaculty();
                
                $em->persist($facultyForm);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Facultatea de ' . $facultyName . ' a fost salvata!'
                );
            }

        }
        $facultyForm = $this->createForm(new FacultyType(), $faculty);
        return $this->render(
            'AppBundle:admin:new_faculty.html.twig',
            ['facultyForm' => $facultyForm->createView()]
        );

    }
    
    /**
     * @Route("/new_course", name="new_course")
     */
    public function newCourseAction(Request $request)
    {
        $faculties = $this->get('general_service')->getFaculty();
        $em = $this->getDoctrine()->getManager();
        $course = new Course();
        $courseForm = $this->createForm(new CourseType($faculties), $course);
        
        $courseForm->handleRequest($request);
        if ($courseForm->isValid()) {

            if ($courseForm->get('insert')->isClicked()) {
                
                $courseForm = $courseForm->getData();
                $courseName = $courseForm->getCourse();
                
                $facultyId = $this->get('general_service')->getFacultyId($courseForm->getFaculty());
                
                $course->setCourse($courseName);
                $course->setFaculty($facultyId);
                $em->persist($course);
                $em->flush();

//                $this->addFlash(
//                    'success',
//                    'Materia ' . $courseName . ' a fost salvata!'
//                );
            }

        }
        $courseForm = $this->createForm(new CourseType($faculties), $course);
        return $this->render(
            'AppBundle:admin:new_course.html.twig',
            ['courseForm' => $courseForm->createView()]
        );

    }
}
