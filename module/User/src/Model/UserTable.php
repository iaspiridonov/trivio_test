<?php

namespace User\Model;

use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\AbstractTableGateway;
use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class UserTable extends AbstractTableGateway
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return User[]|ResultSetInterface
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    /**
     * @return User[]|ResultSetInterface
     */
    public function fetchAllWithCities()
    {
        $table = $this->tableGateway->getTable();
        $select = $this->tableGateway->getSql()->select();
        $select
            ->columns([Select::SQL_STAR])
            ->join(['c' => 'city'], $table . '.city_id = c.id', ['city_name']);

        return $this->tableGateway->selectWith($select);
    }

    public function getUser($id): User
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

    public function saveUser(User $user): void
    {
        $data = [
            'first_name' => $user->firstName,
            'last_name'  => $user->lastName,
            'patronymic' => $user->patronymic,
            'birth_date' => $user->birthDate,
            'city_id'    => $user->cityId
        ];

        $id = $user->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getUser($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update user with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteUser($id): void
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}