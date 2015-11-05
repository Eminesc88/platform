<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FacultyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('faculty', null,  array('label' => 'Nume Facultate'))
            ->add('insert', 'submit', array('label' => 'Inserează'));

    }
    public function getName()
    {
        return 'faculty_form';
    }
}