<?php

namespace User\Model;

use Laminas\Db\ResultSet\ResultSetInterface;
use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class CityTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return City[]|ResultSetInterface
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getCity($id): City
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
}