<?php

namespace User\Model;

use DomainException;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;

class Department implements InputFilterAwareInterface
{
    public int    $id;
    public string $departmentName;

    private $inputFilter;

    public function exchangeArray(array $data): void
    {
        $this->id             = $data['id']              ?? null;
        $this->departmentName = $data['department_name'] ?? null;
    }

    public function getArrayCopy(): array
    {
        return [
            'id'              => $this->id,
            'department_name' => $this->departmentName
        ];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        return;
    }
}