<?php

namespace App\Http\Controllers;

use App\Collections\DeliveryPersonnelCollection;
use App\Http\Requests\DeliveryPersonnelRequest;
use App\Http\Requests\DeliveryPersonnelsRequest;
use App\Http\Resources\DeliveryPersonnelResource;
use App\Services\DeliveryPersonnelService;
use Illuminate\Http\Request;

class DeliveryPersonnelController extends Controller
{
    protected $DeliveryPersonnelService;
    public function __construct(){
        $this->DeliveryPersonnelService = new DeliveryPersonnelService();
    }

    public function index(Request $request){
        $filters = $request->only(['availability']);
        $person = $this->DeliveryPersonnelService->getFilteredPerson($filters);
        return new DeliveryPersonnelCollection($person);
    }

    public function show($id)
    {
        $menu = $this->DeliveryPersonnelService->getPersonById($id);
        return new DeliveryPersonnelResource($menu);
    }

    // Create a new menu
    public function store(DeliveryPersonnelRequest $request)
    {
        $person = $this->DeliveryPersonnelService->createPerson($request->validated());
        return new DeliveryPersonnelResource($person);
    }

    // Update an existing menu
    public function update(DeliveryPersonnelRequest $request, $id)
    {
        $person = $this->DeliveryPersonnelService->getPersonById($id);
        $updatedMenu = $this->DeliveryPersonnelService->updatePerson($person, $request->validated());
        return new DeliveryPersonnelResource($updatedMenu);
    }

    // Delete a menu
    public function destroy($id)
    {
        $person = $this->DeliveryPersonnelService->getPersonById($id);
        $this->DeliveryPersonnelService->deletePerson($person);
        return response()->json(null, 204);
    }

    
}
