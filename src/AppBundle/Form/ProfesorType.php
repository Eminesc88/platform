<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class ProfesorType extends AbstractType {
    
    /**
     * Array that contains the faculties
     * @var array
     */
    private $coursesArray;
    
    /**
     * @param array $faculties
     */
    public function __construct(array $courses)
    {
        
        foreach ($courses as $course)
        {
            $this->coursesArray[] = $course->getCourse();
        }
        
    }
    
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        
        $builder
            ->add('firstName', 'text', array('label' => 'Prenume'))
            ->add('lastName', 'text', array('label' => 'Nume'))
            ->add('course', 'choice', array(
                'choice_list' => new ChoiceList(
                        $this->coursesArray,
                        $this->coursesArray
                ),
                'multiple' => true,
                'required' => true,
                'label' => 'Materii',
            ))
            ->add('insert', 'submit', array('label' => 'Adauga'));
    
    }    
    public function getName()
    {
        return 'legalHoliday_form';
    }
}
