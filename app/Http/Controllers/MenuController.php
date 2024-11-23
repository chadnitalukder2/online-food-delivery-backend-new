<?php

namespace App\Http\Controllers;

use App\Collections\MenusCollection;
use App\Http\Requests\MenusRequest;
use App\Http\Resources\MenusResource;
use App\Services\MenusService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct()
    {
        $this->menuService = new MenusService();
    }

    // Get all menus with optional filtering and pagination
    public function index(Request $request)
    {
        $filters = $request->only(['availability', 'restaurant_id', 'price_min', 'price_max']);
        $menus = $this->menuService->getFilteredMenus($filters);
        return new MenusCollection($menus);
    }

    public function show($id)
    {
        $menu = $this->menuService->getMenuById($id);
        return new MenusResource($menu);
    }

    public function store(MenusRequest $request)
    {
        $menu = $this->menuService->createMenu($request->validated());
        return new MenusResource($menu);
    }


    public function update(MenusRequest $request, $id)
    {
        $menu = $this->menuService->getMenuById($id);
        $updatedMenu = $this->menuService->updateMenu($menu, $request->validated());
        return new MenusResource($updatedMenu);
    }

    public function destroy($id)
    {
        $menu = $this->menuService->getMenuById($id);
        $this->menuService->deleteMenu($menu);
        return response()->json(null, 204);
    }


  


}
