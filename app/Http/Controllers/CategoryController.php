<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Builder
        // $query = DB::table('categories')->orderBy('id','DESC');
        // if($request->has('search')){
        //     $query -> where('name','like','%'.$request->search.'%');
        // }
        // $categories = $query->paginate(5);
        // return view('categories.index',compact('categories'));

        //Eloqunet
        $query = Category::query();
        if($request->has('search')){
            $query -> where('name','like','%'.$request->search.'%');
        }
        $categories = $query->orderBy('id','DESC')->paginate(5);
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
        //Query Builder
        // DB::table('categories')->insert([
        //     'name' => $request -> name,
        //     'status' => (bool) $request -> status
        // ]);
        // return redirect()->route('categories.index')->with('success','Thêm danh mục thành công');

        //Eloquent
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success','Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Query Builder
        // $detailCate = DB::table('categories')->where('id',$id)->first();
        // return view('categories.show',compact('detailCate'));

        //Eloquent
        $detailCate = Category::find($id);
        return view('categories.show',compact('detailCate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //Query Builder
        // $cateOld = DB::table('categories')->where('id',$id)->first();
        // return view('categories.edit',compact('cateOld'));

        //Eloquent
        // $cateOld = Category::find($id);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,Category $category)
    {
        //Query Builder
        // $oldStatus = DB::table('categories')->where('id', $id)->value('status');

        // DB::table('categories')->where('id',$id)->update([
        //     'name'=>$request->name,
        //     'status'=> (bool) $request->status,
        // ]);

        // // Nếu danh mục chuyển từ 1 -> 0, cập nhật sản phẩm về 0
        // if ($oldStatus == 1 && $request->status == 0) {
        //     DB::table('products')->where('category_id', $id)->update(['status' => 0]);
        // }
        
        // // Nếu danh mục chuyển từ 0 -> 1, cập nhật sản phẩm về 1
        // if ($oldStatus == 0 && $request->status == 1) {
        //     DB::table('products')->where('category_id', $id)->update(['status' => 1]);
        // }
        // return redirect()->route('categories.index')->with('success','Sửa danh mục thành công');

        // Eloquent
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success','Sửa danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {    
        //Query Builder
        // $productCount = DB::table('products')->where('category_id',$id)->count();
        // if($productCount > 0){
        //     return redirect()->back()->with('error', 'Không thể xóa danh mục vì vẫn còn sản phẩm.');
        // }

        // $destroy = DB::table('categories')->where('id',$id)->update(['status'=>'2']);
        // if($destroy){
        //     return redirect()->route('categories.index')->with('success','Ẩn danh mục thành công');
        // }
        $category->delete();
        return redirect()->route('categories.index')->with('success','Ẩn danh mục thành công');
    }

    public function backCate(string $id){
        DB::table('categories')->where('status','2')->where('id',$id)->update(['status'=>'1']);
        return redirect()->route('categories.index')->with('success','Khôi phục thành công');
    }
}
