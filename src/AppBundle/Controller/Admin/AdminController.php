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
use AppBundle\Entity\Profesor;
use AppBundle\Form\ProfesorType;


class AdminController extends Controller
{
    /**
     * @Route("/delete_course/{id}", name="delete_course")
     */
    public function deleteAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        if ($id) {
            $course = $em->find('AppBundle:Course', $id);
            $em->remove($course);
        }
        $em->flush();
        return $this->redirectToRoute('new_course');
    }
    
    /**
     * @Route("/new_faculty", name="new_faculty")
     */
    public function newFacultyAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $faculties = $this->get('general_service')->getFaculty();
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
            return $this->redirectToRoute('new_faculty', array('show' => 1));
        }
        
        $facultyForm = $this->createForm(new FacultyType(), $faculty);
        return $this->render(
            'AppBundle:admin:new_faculty.html.twig',
            array('facultyForm' => $facultyForm->createView(),
                  'faculties' => !empty($faculties) ? $faculties : null
                )
        );

    }
    
    /**
     * @Route("/new_course", name="new_course")
     */
    public function newCourseAction(Request $request)
    {
        $faculties = $this->get('general_service')->getFaculty();
        $courses = $this->get('general_service')->getCourse();
        
        
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

                $this->addFlash(
                    'success',
                    'Materia ' . $courseName . ' a fost salvata!'
                );
                return $this->redirectToRoute('new_course', array('show' => 1));
            }

        }
        
        $courseForm = $this->createForm(new CourseType($faculties), $course);
        return $this->render(
            'AppBundle:admin:new_course.html.twig',
            array('courseForm' => $courseForm->createView(),
                  'courses' => $courses
                )
        );

    }
    /**
     * 
     * @Route("/new_profesor", name="new_profesor")
     */
    public function newProfesorAction (Request $request)
    {
        $courses = $this->get('general_service')->getCourse();
        
        
        $em = $this->getDoctrine()->getManager();
        $prof = new Profesor();
        $profesorForm = $this->createForm(new ProfesorType($courses), $prof);
        
        $profesorForm->handleRequest($request);
        if ($profesorForm->isValid()) {

            if ($profesorForm->get('insert')->isClicked()) {
                
                $profesorForm = $profesorForm->getData();
                var_dump($profesorForm); die;
                $courseId = $this->get('general_service')->getCourseId($profesorForm->getCourse());
                
                

                $this->addFlash(
                    'success',
                    'Materia ' . $courseName . ' a fost salvata!'
                );
                return $this->redirectToRoute('new_course', array('show' => 1));
            }

        }
        
        $profesorForm = $this->createForm(new ProfesorType($courses), $prof);
        return $this->render(
            'AppBundle:admin:new_profesor.html.twig',
            array('profesorForm' => $profesorForm->createView()
                )
        );

    }
}
