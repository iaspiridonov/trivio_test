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

class User implements InputFilterAwareInterface
{
    public int     $id;
    public string  $firstName;
    public string  $lastName;
    public ?string $patronymic;
    public string  $birthDate;
    public string  $cityId;
    public ?string $cityName;

    private $inputFilter;

    public function exchangeArray(array $data): void
    {
        $this->id         = $data['id']         ?? null;
        $this->firstName  = $data['first_name'] ?? null;
        $this->lastName   = $data['last_name']  ?? null;
        $this->patronymic = $data['patronymic'] ?? null;
        $this->birthDate  = $data['birth_date'] ?? null;
        $this->cityId     = $data['city_id']    ?? null;
        $this->cityName   = $data['city_name']  ?? null;
    }

    public function getArrayCopy(): array
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->firstName,
            'last_name'  => $this->lastName,
            'patronymic' => $this->patronymic,
            'birth_date' => $this->birthDate,
            'city_id'    => $this->cityId,
            'city_name'  => $this->cityName
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
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter
            ->add([
                'name' => 'id',
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ])
            ->add($this->getDefaultInputFilter('first_name'))
            ->add($this->getDefaultInputFilter('last_name'))
            ->add($this->getDefaultInputFilter('patronymic', false))
            ->add([
                'name' => 'birth_date',
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'                   => Regex::class,
                        'options'                => [
                            'pattern' => '/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/', // yyyy-mm-dd
                            'message' => 'Поддерживаемый формат даты: yyyy-mm-dd'
                        ]
                    ]
                ],
            ])
            ->add([
                'name' => 'city_id',
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ]
            ])
        ;

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

    private function getDefaultInputFilter(string $name, bool $isRequired = true): array
    {
        return [
            'name' => $name,
            'required' => $isRequired,
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
                        'max' => 100,
                    ],
                ],
                [
                    'name'                   => Regex::class,
                    'options'                => [
                        'pattern' => '/^[a-zа-яA-ZА-ЯёЁ]*$/iu', // Only letters
                        'message' => 'Введены недопустимые символы'
                    ]
                ]
            ],
        ];
    }
}