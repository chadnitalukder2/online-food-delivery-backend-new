<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Menu;
use GuzzleHttp\Psr7\Request;

class MenusService
{
    // Get all menus with optional filtering and pagination
    public function getFilteredMenus(array $filters, $perPage = 10)
    {
        $query = Menu::query();

        if (isset($filters['availability'])) {
            $query->where('availability', $filters['availability']);
        }

        if (isset($filters['restaurant_id'])) {
            $query->where('restaurant_id', $filters['restaurant_id']);
        }

        if (isset($filters['price_min']) && isset($filters['price_max'])) {
            $query->whereBetween('price', [$filters['price_min'], $filters['price_max']]);
        }

        return $query->get();
    }

    public function getMenuById($id)
    {
        return Menu::findOrFail($id);
    }

    public function createMenu(array $data)
    {
        return Menu::create($data);
    }

    public function updateMenu(Menu $menu, array $data)
    {
        $menu->update($data);
        return $menu;
    }

    public function deleteMenu(Menu $menu)
    {
        $menu->delete();
    }
}
