<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('categories')->orderBy('id','DESC');
        if($request->has('search')){
            $query -> where('name','like','%'.$request->search.'%');
        }
        $categories = $query->paginate(5);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        DB::table('categories')->insert([
            'name' => $request -> name,
            'status' => (bool) $request -> status
        ]);
        return redirect()->route('categories.index')->with('success','Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detailCate = DB::table('categories')->where('id',$id)->first();
        return view('categories.show',compact('detailCate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cateOld = DB::table('categories')->where('id',$id)->first();
        return view('categories.edit',compact('cateOld'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        DB::table('categories')->where('id',$id)->update([
            'name'=>$request->name,
            'status'=> (bool) $request->status,
        ]);
        return redirect()->route('categories.index')->with('success','Sửa danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        //set null cho danh mục sp
        // DB::table('products')->where('category_id', $id)->update(['category_id' => NULL,'status'=>'0']);
            
        //xóa hết sp
        DB::table('products')->where('category_id', $id)->delete();
        $destroy = DB::table('categories')->where('id',$id)->delete();
        if($destroy){
            return redirect()->route('categories.index')->with('success','Xóa danh mục thành công');
        }
       
    }
}
