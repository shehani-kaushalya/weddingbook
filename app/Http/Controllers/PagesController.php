<?php

namespace App\Http\Controllers;

use App\Pages;
use App\Services\FileService;
use App\Services\PagesService;
use App\Services\RequestService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Redirect;

class PagesController extends Controller
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
        $page_data['page'] = "Page Listing";
        $pages_data = $this->pagesService->getAllPages();
        // print_r($pages_data);
        // exit;
        return view('admin/pages/pages_list', compact('pages_data', 'page_data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd("Page creation");
        $page_data['page'] = "New page create";
        $category_data = $this->pagesService->getAllCategories();
        // print_r($category_data);
        // exit;
        // return view('admin.pages.page')->with('page_data', $page_data);
        return view('admin.pages.page', compact('category_data', 'page_data'));
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
            $pageId = $data['pageId'];

            if ($pageId != "") {

                $pageObj = Pages::find($pageId);
                $page_cat = $pageObj['category_id'];

                print_r($page_cat);

                if ($page_cat != $data['category_id']) {
                    print("This is not page cat");
                    $pageObj = Pages::where('name', trim($data['name']))->where('category_id', [$data['category_id']])->get();

                    if ($pageObj) {
                        return Redirect::to('admin/pages')->with('error_message', 'Page already exist in the category');
                    }

                } else {
                    print("This is page cat");
                    $pageObj = Pages::where('name', trim($data['name']))->where('category_id', [$page_cat])->get();
                }

                // print_r($pageObj);
                // exit;

                $pageObj = Pages::find($pageId);

                if (@$data['name'] != "") {
                    $pageObj->name = $data['name'];
                }
                if (@$data['slug'] != "") {
                    $pageObj->slug = $data['slug'];
                }

                if (@$data['body'] != "") {
                    $pageObj->body = $data['body'];
                }

                if (@$data['meta_title'] != "") {
                    $pageObj->meta_title = $data['meta_title'];
                }

                if (@$data['meta_description'] != "") {
                    $pageObj->meta_description = $data['meta_description'];
                }

                if (@$data['meta_keywords'] != "") {
                    $pageObj->meta_keywords = $data['meta_keywords'];
                }

                if (@$data['meta_type'] != "") {
                    $pageObj->meta_type = $data['meta_type'];
                }

                if (@$data['status'] != "") {
                    $pageObj->status = $data['status'];
                }

                if (@$data['upload'] != "") {

                    $img = FileService::save($data['upload'], "pages");
                    $data['image'] = "pages/" . $data['upload'];

                    $pageObj->featured_image = $img;

                }

                // print_r($pageObj);
                // exit;

                $pageObj->save();
                // $list_categories = $this->PagesService->getAllCategories();
                //->with('list_categories', $list_categories)
                return Redirect::to('admin/pages')->with('success_message', 'Page information sucessfully updated in the system');

            } else {

                // print("Category Add Section");
                // print_r($data);
                // exit;

                $page = Pages::where('name', $data['name'])->first();
                $pageObj = Pages::find($page['pageId']);

                // print($pageObj);

                if (!$pageObj) {

                    if (@$data['upload'] != "") {

                        $img = FileService::save($data['upload'], "pages");
                        $data['image'] = "pages/" . $data['upload'];

                    } else {
                        $img = "";
                    }

                    $pageObj = Pages::firstOrNew(
                        [
                            'name' => $data['name'],
                            'category_id' => $data['category_id'],
                            'slug' => $data['slug'],
                            'description' => '',
                            'body' => $data['body'],
                            'featured_image' => $img,
                            'meta_title' => $data['meta_title'],
                            'meta_keywords' => $data['meta_keywords'],
                            'meta_description' => $data['meta_description'],
                            'meta_type' => $data['meta_type'],
                            'status' => $data['status'],
                        ]);
                    // print("-----------------------------------------");
                    // print_r($pageObj);
                    // print("==========================================");
                    // exit;

                    $pageObj->save();
                    return Redirect::to('admin/pages')->with('success_message', 'Page sucessfully added in the system');

                } else {
                    // print("Page exist");
                    // print_r($data);
                    // exit;
                    return Redirect::to('admin/pages')->with('error_message', 'Page already exist in the database');
                }

                // print_r("=======================================");
                // exit;

            }

        } else {

            return Redirect::to('admin/pages/category')->with('success_message', 'Page sucessfully updated in the system');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Pages $pages)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pages $pages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pages $pages)
    {
        //
    }

    public function getPagesData($id)
    {

        $pages_data = $this->pagesService->getCurrentPage($id);
        $category_data = $this->pagesService->getAllCategories();
        $page_data['page'] = "Edit page";

        // print($pages_data->name);
        // exit;
        // return view('admin.pages.page')->with('page_data', $page_data);
        return view('admin.pages.page', compact('category_data', 'pages_data', 'page_data'));

    }

    public function pageView($id)
    {
        $pages_data = $this->pagesService->getCurrentPage($id);
        $category_data = $this->pagesService->getAllCategories();
        $page_data['page'] = "Edit page";

        // print($pages_data->name);
        // exit;
        return view('admin.pages.page_view', compact('pages_data', 'page_data'));
    }

    public function aboutPage()
    {

        return view('customer.page.about');
    }

    public function viewPage($slug)
    {

        $page = Pages::where('slug', $slug)->first();

        return view('customer.page.single', compact('page'));
    }

}