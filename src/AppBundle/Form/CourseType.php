<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use AppBundle\Entity\Faculty;

class CourseType extends AbstractType {
    
    /**
     * Array that contains the faculties
     * @var array
     */
    private $facultiesArray;
    
    /**
     * @param array $faculties
     */
    public function __construct(array $faculties)
    {
        foreach ($faculties as $faculty)
        {
            $this->facultiesArray[] = $faculty->getFaculty();
        }
    }
    
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        
        $builder
            ->add('course', 'text', array('label' => 'Materia'))
            ->add('faculty', 'choice', array(
                'choice_list' => new ChoiceList(
                        $this->facultiesArray,
                        $this->facultiesArray
                ),
                'multiple' => false,
                'required' => true,
                'label' => 'Facultatea',
            ))
                
            ->add('insert', 'submit', array('label' => 'Insereaza'));
    
    }    
    public function getName()
    {
        return 'legalHoliday_form';
    }
}
