<?php

namespace User\Model;

use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\AbstractTableGateway;
use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class DepartmentTable extends AbstractTableGateway
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return Department[]|ResultSetInterface
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    /**
     * @return Department[]|ResultSetInterface
     */
    public function fetchAllWithUsers()
    {
        return;
    }

    public function getDepartment($id): Department
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function addUserToDepartment(Department $user): void
    {
        return;
    }

    public function deleteUserFromDepartment($id): void
    {
        return;
    }
}