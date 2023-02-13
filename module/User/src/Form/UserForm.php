<?php

namespace User\Form;

use Laminas\Form\Element\Select;
use Laminas\Form\Form;

class UserForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');

        $select = new Select('city_id');
        $select->setLabel('city');
        // @TODO заполнять из БД
        $select->setValueOptions([
            1 => 'Москва',
            2 => 'Екатеринбург',
            3 => 'Клин'
        ]);

        $this
            ->add([
                'name' => 'id',
                'type' => 'hidden',
            ])
            ->add([
                'name' => 'first_name',
                'type' => 'text',
                'options' => [
                    'label' => 'First name',
                ],
            ])
            ->add([
                'name' => 'last_name',
                'type' => 'text',
                'options' => [
                    'label' => 'Last name',
                ],
            ])
            ->add([
                'name' => 'patronymic',
                'type' => 'text',
                'options' => [
                    'label' => 'Patronymic',
                ],
            ])
            ->add([
                'name' => 'birth_date',
                'type' => 'text',
                'options' => [
                    'label' => 'Birth date',
                ],
            ])
            ->add($select)
            ->add([
                'name' => 'submit',
                'type' => 'submit',
                'attributes' => [
                    'value' => 'Go',
                    'id'    => 'submitbutton',
                ],
            ])
        ;
    }
}