<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $query = DB::table('products','p')->leftJoin('categories as c','p.category_id','=','c.id')->select('p.*','c.name as cate_name')->orderBy('p.id','DESC');
        if($request->has('search')){
            $query->where('p.name','like','%'.$request->search.'%');
        }
        $products = $query->paginate(6);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $imagePath = 'uploads/products/' . $imageName;
        } else {
            $imagePath = null;
        }
        DB::table('products')->insert([
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'image'=>$imagePath,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'status'=>$request->status,
        ]);
        return redirect()->route('products.index')->with('success','Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detailPro = DB::table('products','p')->where('p.id',$id)
        ->leftJoin('categories as c','p.category_id','=','c.id')
        ->select('p.*','c.name as cate_name')
        ->first();
        return view('products.show',compact('detailPro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proOld = DB::table('products','p')->where('p.id',$id)
        ->leftJoin('categories as c','p.category_id','=','c.id')
        ->select('p.*','c.name as cate_name')
        ->first();
        $categories = DB::table('categories')->get();
        return view('products.edit',compact('proOld','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $proOld = DB::table('products','p')->where('p.id',$id)
        ->leftJoin('categories as c','p.category_id','=','c.id')
        ->select('p.*','c.name as cate_name')
        ->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $imagePath = 'uploads/products/' . $imageName;
    
            if ($proOld->image && file_exists(public_path($proOld->image))) {
                unlink(public_path($proOld->image));
            }
        } else {
            $imagePath = $proOld->image;
        }
        DB::table('products')->where('id',$id)->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'image'=>$imagePath,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'status'=> (bool) $request->status,
        ]);
        return redirect()->route('products.index')->with('success','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('products')->where('id',$id)->delete();
        return redirect()->route('products.index')->with('success','Xóa thành công');
    }
}
