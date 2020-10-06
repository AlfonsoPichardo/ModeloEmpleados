<?php      
namespace Project\Model;

use DomainException;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\StringLength;


class Project
{
    public $project_id;
    public $title;
    public $start_date;
    public $complete;

    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->project_id     = !empty($data['project_id']) ? $data['project_id'] : null;
        $this->title = !empty($data['title']) ? $data['title'] : null;
        $this->start_date  = !empty($data['start_date']) ? $data['start_date'] : null;
        $this->complete  = !empty($data['complete']) ? $data['complete'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'project_id'     => $this->project_id,
            'title'  => $this->title,
            'start_date' => $this->start_date,
            'complete' => $this->complete
        ];
    }

    /* Add the following methods: */

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'project_id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'title',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 85,
                    ],
                ],
            ],
        ]);

// fechaa

        $inputFilter->add([
            'name' => 'start_date',
            'required' => true,
            'filters' => [
                ['name' => ToDate::class],
            ],
        ]);


        $inputFilter->add([
            'name' => 'complete',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 8,
                    ],
                ],
            ],
        ]);



        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}

?>