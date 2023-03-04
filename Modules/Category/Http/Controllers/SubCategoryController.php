<?php

namespace Modules\Category\Http\Controllers;

use App\Models\AdType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Actions\CreateSubCategory;
use Modules\Category\Actions\DeleteSubCategory;
use Modules\Category\Actions\UpdateSubCategory;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Category\Http\Requests\SubCategoryFormRequest;

class SubCategoryController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('subcategory.view')) {
            abort(403);
        }
        $sub_categories = SubCategory::withCount('ads')->latest()->get();
        return view('category::subcategory.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!userCan('subcategory.create')) {
            abort(403);
        }

        $categories = Category::all();

        if ($categories->count() < 1) {
            flashWarning("You don't have any active category. Please create or active category first.");
            return redirect()->route('module.category.create');
        }
        $ad_types = AdType::orderBy('id','desc')->get();
        return view('category::subcategory.create', compact('categories','ad_types'));
    }

    /**
     * Store a newly created resource in storage.
     * @param SubCategoryFormRequest $request
     * @return Renderable
     */
    public function store(SubCategoryFormRequest $request)
    {
        if (!userCan('subcategory.create')) {
            abort(403);
        }
        $subcategory = CreateSubCategory::create($request);

        if ($subcategory) {
            flashSuccess('SubCategory Added Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(SubCategory $subcategory)
    {
        if (!userCan('subcategory.update')) {
            abort(403);
        }
        $categories = Category::all();
        $ad_types = AdType::orderBy('id','desc')->get();
        return view('category::subcategory.edit', compact('subcategory', 'categories','ad_types'));
    }

    /**
     * Update the specified resource in storage.
     * @param SubCategoryFormRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(SubCategoryFormRequest $request, SubCategory $subcategory)
    {
        if (!userCan('subcategory.update')) {
            abort(403);
        }
        $subcategory = UpdateSubCategory::update($request, $subcategory);

        if ($subcategory) {
            flashSuccess('SubCategory Updated Successfully');
            return redirect(route('module.subcategory.index'));
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(SubCategory $subcategory)
    {
        if (!userCan('subcategory.delete')) {
            abort(403);
        }

        $subcategory = DeleteSubCategory::delete($subcategory);

        if ($subcategory) {
            flashSuccess('SubCategory Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    public function show(SubCategory $subcategory)
    {
        $subcategory->loadCount('ads', 'category');
        $ads = $subcategory->ads;

        // return [
        //     'subcategory' => $subcategory,
        //     'ads' => $ads
        // ];

        return view('category::subcategory.show', compact('ads', 'subcategory'));
    }

    public function status_change(Request $request)
    {
        $product = SubCategory::findOrFail($request->id);
        $product->status = $request->status;
        $product->save();

        if ($request->status == 1) {
            return response()->json(['message' => 'Subcategory Activated Successfully']);
        } else {
            return response()->json(['message' => 'Subcategory Inactivated Successfully']);
        }
    }
}
