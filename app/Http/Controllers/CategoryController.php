<?php

namespace App\Http\Controllers;

use App\Collections\CategoriesCollection;
use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\CategoriesResource;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $CategoriesService;

    public function __construct()
    {
        $this->CategoriesService = new CategoriesService();
    }

    public function index(Request $request)
    {
        $categories = $this->CategoriesService->getCategories();
        return new CategoriesCollection($categories);
    }
    public function show($id){
        $categories = $this->CategoriesService->getCategoryById($id);
        return new CategoriesResource($categories);
    }

    public function store(CategoriesRequest $request){
        $categories = $this->CategoriesService->createCategory($request->validated());
        return new CategoriesResource($categories);
    }

    public function update(CategoriesRequest $request, $id)
    {
        $categories = $this->CategoriesService->getCategoryById($id);
        $updatedCategories = $this->CategoriesService->updatedCategories($categories, $request->validated());
        return new CategoriesResource($updatedCategories);
    }

    // Delete 
    public function destroy($id)
    {
        $categories = $this->CategoriesService->getCategoryById($id);
        $this->CategoriesService->deleteCategory($categories);
        return response()->json(null, 204);
    }

}
