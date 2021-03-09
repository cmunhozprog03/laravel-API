<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $categories = $this->category->getResults($request->name);
                        
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category, 201 );

    }

    public function update(Request $request, $id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error', 'categoria não encontrda']);

        $category->update($request->all());

        return response()->json($category);
    }

    
}
