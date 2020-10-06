<?php
namespace Project\Form;

use Laminas\Form\Form;




class ProjectForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('album');

        $this->add([
            'name' => 'project_id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title',
            ],
        ]);

        $this->add([
            'type' => Element\Date::class,
            'name' => 'start_date',
            'options' => [
            'label' => 'Appointment Date',
            'format' => 'Y-m-d',
             ],
            'attributes' => [
                'min' => '2000-01-01',
                'max' => '2020-09-01',
                'step' => '1', // days; default step interval is 1 day
                ],
        ]);

        $this->add([
            'name' => 'complete',
            'type' => 'text',
            'options' => [
                'label' => 'Complete',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}



?>