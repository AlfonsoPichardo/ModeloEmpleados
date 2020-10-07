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
            'name' => 'id',
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
            'name' => 'st_date',
            'type' => 'text',
            'options' => [
                'label' => 'Fecha Inicio',
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