<?php

namespace App\Services;

use App\Models\Category;
use App\Models\DeliveryPersonnel;
use App\Models\Menu;
use GuzzleHttp\Psr7\Request;

class DeliveryPersonnelService
{
    // Get all menus with optional filtering and pagination
    public function getFilteredPerson(array $filters, $perPage = 10)
    {
        $query = DeliveryPersonnel::query();

        if (isset($filters['availability'])) {
            $query->where('availability', $filters['availability']);
        }

        return $query->get();
    }

    public function getPersonById($id)
    {
        return DeliveryPersonnel::findOrFail($id);
    }

    public function createPerson(array $data)
    {
        return DeliveryPersonnel::create($data);
    }

    public function updatePerson(DeliveryPersonnel $person, array $data)
    {
        $person->update($data);
        return $person;
    }

    public function deletePerson(DeliveryPersonnel $person)
    {
        $person->delete();
    }
}
