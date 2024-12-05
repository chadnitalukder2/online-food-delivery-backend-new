<?php

namespace App\Services;

use App\Models\Category;
use GuzzleHttp\Psr7\Request;

class CategoriesService
{
    public function geCategoryByOwner($id)
    {
        return Category::where('user_id', $id)->get();
    }

    public function getCategories()
    {
        $query = Category::query();
        return $query->orderBy('id', 'desc')->get();
       
    }
    public function getCategoryById($id){
        return Category::findOrFail($id);

    }

    public function createCategory(array $data){
        return Category::create($data);

    }

    public function updatedCategories(Category $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    // Delete a menu
    public function deleteCategory(Category $category)
    {
        $category->delete();
    }


}
