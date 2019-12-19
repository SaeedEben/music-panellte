<?php

namespace App\Http\Controllers\Panel\Music;

use App\Http\Controllers\Controller;
use App\Http\Requests\Music\Category\StoreCategoryRequest;
use App\Http\Requests\Music\Category\UpdateCategoryRequest;
use App\Http\Resources\Music\Category\CategoryIndexResource;
use App\Http\Resources\Music\Category\CategoryShowResource;
use App\Models\Music\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|object
     *
     */
    public function index()
    {
        $category = Category::paginate();
        return CategoryIndexResource::collection($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response|array
     */
    public function store(StoreCategoryRequest $request)
    {
        \DB::beginTransaction();
        try {
            $category = new Category();

            $translation = [
                'en' => $request->name['en'],
                'fa' => $request->name['fa'],
            ];
            $category->setTranslations('name' , $translation);

            $category->fill($request->all());
            $category->save();

            \DB::commit();

            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.store'),
            ];
        }catch (\Exception $exception){
            \DB::rollBack();

            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @return CategoryShowResource
     */
    public function show(Category $category)
    {
        return new CategoryShowResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category                 $category
     *
     * @return array
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        \DB::beginTransaction();

        try {
            $translations = [
                'en' => $request->name['en'],
                'fa' => $request->name['fa'],
            ];

            $category->setTranslations('name' , $translations);

            $category->fill($request->all());
            $category->save();

            \DB::commit();
            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.update'),
            ];
        }catch (\Exception $exception){
            \DB::rollBack();

            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @return \Illuminate\Http\Response|array
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.delete'),
            ];
        }catch(\Exception $exception){
            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response|array
     * @throws \Exception
     */
    public function restore($id)
    {
        try {
            Category::onlyTrashed()->findOrFail($id)->restore();
            return [
                'success' => true,
                'message' => trans('responses.panel.music.message.restore'),
            ];
        }catch(\Exception $exception){
            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }

    public function list()
    {
       return Category::select('id' , 'name')->get();
    }
}
