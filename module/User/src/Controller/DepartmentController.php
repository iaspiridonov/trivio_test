<?php

declare(strict_types=1);

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Model\DepartmentTable;

class DepartmentController extends AbstractActionController
{
    private $table;

    public function __construct(DepartmentTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel([
            'departments' => $this->table->fetchAll()
        ]);
    }
}
