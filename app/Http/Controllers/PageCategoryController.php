<?php

namespace App\Http\Controllers;

use App\PageCategory;
use App\Services\FileService;
use App\Services\PagesService;
use App\Services\RequestService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Redirect;

class PageCategoryController extends Controller
{

    public function __construct(UserService $userService, RequestService $requestService,
        PagesService $pagesService) {
        $this->userService = $userService;
        $this->requestService = $requestService;
        $this->pagesService = $pagesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("List category");
        $page_data['page'] = "Category listing";
        $category_data = $this->pagesService->getAllCategories();
        // $category_data['page'] =  "Category List";

        // print_r($page_data);
        // exit;
        // return view('admin/pages/category_list')->with('category_data', $category_data);
        return view('admin/pages/category_list', compact('category_data', 'page_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_data['page'] = "New category create";
        return view('admin.pages.category')->with('category_data', $category_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            $categoryId = $data['id'];

            // print_r($data['name']);
            // exit;

            if ($categoryId != "") {

                // print("Edit Section");
                // exit;

                $categoryObj = PageCategory::find($categoryId);

                if (@$data['name'] != "") {
                    $categoryObj->name = $data['name'];
                }
                if (@$data['description'] != "") {
                    $categoryObj->description = $data['description'];
                }
                if (@$data['status'] != "") {
                    $categoryObj->status = $data['status'];
                }

                if (@$data['upload'] != "") {

                    $categoryObj->image = $data['upload'];
                    $img = FileService::save($categoryObj->image, "pages_category");
                    $categoryObj->image = "pages/" . $img;
                    $categoryObj->image = $img;

                }

                $categoryObj->save();
                // $list_categories = $this->PagesService->getAllCategories();
                //->with('list_categories', $list_categories)
                return Redirect::to('admin/pages/category/list')->with('success_message', 'Category sucessfully updated in the system');

            } else {

                // print("Category Add Section");
                // exit;
                // print_r($data);

                $category = PageCategory::where('name', $data['name'])->first();
                $categoryObj = PageCategory::find($category['id']);

                if (!$categoryObj) {

                    if (@$data['upload'] != "") {

                        $img = FileService::save($data['upload'], "pages");
                        $data['image'] = "pages/" . $data['upload'];

                    } else {
                        $img = "";
                    }

                    $categoryObj = PageCategory::firstOrNew(
                        [
                            'name' => $data['name'],
                            'description' => $data['description'],
                            'image' => $img,
                            'status' => $data['status'],
                        ]);
                    // print("-----------------------------------------");
                    // print_r($categoryObj);
                    // print("==========================================");
                    // exit;

                    $categoryObj->save();
                    return Redirect::to('admin/pages/category/list')->with('success_message', 'Category sucessfully added in the system');

                } else {
                    // print("Category exist");
                    // print_r($data);
                    // exit;
                    return Redirect::to('admin/pages/category/list')->with('error_message', 'Category already exist in the database');
                }

                // print_r("=======================================");
                // exit;

            }

        } else {

            return Redirect::to('admin/pages/category')->with('success_message', 'Category sucessfully updated in the system');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PageCategory $pageCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PageCategory $pageCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageCategory $pageCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageCategory $pageCategory)
    {
        //
    }

    public function getCategoryData($id)
    {

        $category_data = $this->pagesService->getCurrentCategroy($id);
        $category_data['page'] = "Edit category create";
        return view('admin.pages.category')->with('category_data', $category_data);

    }

    public function category_delete($id)
    {

        try {

            $category_data = $this->pagesService->getCurrentCategroy($id);
            $imageFile = $category_data['image'];

            $categoryItemData = FileService::fileExist($imageFile);

            if ($categoryItemData == true) {
                $this->pagesService->setDeleteCategoryItem($id);
                return Redirect::to('admin/pages/category/list');
            } else {
                $this->sliderService->setDeleteCategoryItem($id);
                return Redirect::to('admin/pages/category/list');
            }

        } catch (\Exception $e) {
            //var_dump($e->errorInfo);
            return Redirect::to('admin/pages/category/list')->with('error_message', 'Pages are already exist in this category ');
        }

    }

}