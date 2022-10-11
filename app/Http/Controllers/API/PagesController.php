<?php

namespace App\Http\Controllers\API;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SavePageRequest;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $p_id='', Request $req)
    {
      if($id == 1){
        $pages = Page::where('parent_id', $id)->get();
      }else{
        $slug = $id.'-'.$p_id;
        $pages = Page::where('slug', $slug)->get();
      }
        return response()->json([
          'success' => true,
          'message' =>  'data retrived',
          'pages' => $pages
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nested_page($slug, Request $req)
    {
        $page = Page::where('slug', $slug)->first();
        if($page)
        $nested_pages = Page::where('parent_id', $page->id)->get();
        else
        $nested_pages = [];
        return response()->json([
          'success' => true,
          'message' =>  'data retrived',
          'pages' => $nested_pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePageRequest $request)
    {
      try {
        DB::beginTransaction();
        $data = $request->except('id');
        $title = explode(' ',$data['title']);
        $titleSlug = '';
        foreach ($title as $key => $value) {
          $titleSlug .= '-'.$value;
        }
        if($data['parent_id']==1)
        $data['slug'] = $data['parent_id'];
        else if(isset($request->id) && $request->id)
        $data['slug'] = $data['parent_id'].'-'.$request->id;
        else
        $data['slug'] = $data['parent_id'];
        
        $page = Page::create($data);

        if($page){
          DB::commit();
          return response()->json([
            'success' => true,
            'message' =>  'Page Saved Successfully',
            'page' => $page
          ]);
        }else{
          DB::rollback();
          return response()->json([
            'success' => false,
            'message' => $error,
            'page' => []
          ]);
        }
      } catch (\Throwable $th) {
        DB::rollback();
        return $th;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Page $pages)
    {
      return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $pages)
    {
      return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $pages)
    {
      return 'update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $pages)
    {
      return 'destroy';
    }
}
