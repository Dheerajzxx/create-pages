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
            'message' => 'Page Not Saved',
            'page' => []
          ]);
        }
      } catch (\Throwable $th) {
        DB::rollback();
        return $th;
      }
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
      try {
        DB::beginTransaction();
        $data = $request->only('title', 'content');
        
        $page = Page::whereId($request->id)->update($data);

        if($page){
          DB::commit();
          return response()->json([
            'success' => true,
            'message' =>  'Page Updated Successfully',
            'page' => $page
          ]);
        }else{
          DB::rollback();
          return response()->json([
            'success' => false,
            'message' => 'Page Not Saved',
            'page' => []
          ]);
        }
      } catch (\Throwable $th) {
        DB::rollback();
        return $th;
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
      $page = Page::find($req->id);
      if ($page) {
        Page::find($req->id)->delete();
        return response()->json([
          'success' => true,
          'message' =>  'Page Deleted Successfully',
          'page' => []
        ]);
      }else{
        return response()->json([
          'success' => false,
          'message' =>  'Page Data Not Found',
          'page' => []
        ]);
      }
    }
}
