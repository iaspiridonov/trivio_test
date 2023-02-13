<?php

namespace User\Model;

class City
{
    public int    $id;
    public string $cityName;

    public function exchangeArray(array $data): void
    {
        $this->id = $data['id']        ?? null;
        $this->id = $data['city_name'] ?? null;
    }

    public function getArrayCopy(): array
    {
        return [
            'id'        => $this->id,
            'city_name' => $this->cityName
        ];
    }
}