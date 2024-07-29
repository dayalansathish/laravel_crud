<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Hoa\Console;

class ProductController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if (!Auth::check()){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $userId = Auth::id();
        $products = Product::where('user_id',$userId)->paginate(5);
        // dd($products);
        // Retrieve the status code from the response headers
        $statusCode = session('status_code', 200);
        // dd($statusCode);
        return view("components.AdminDashboard", [
            "products" => $products,
            "statusCode" => $statusCode
        ]);
    }

    // public function index()
    // {
    //     $products = Product::withTrashed()->paginate(5);
    //     return view("components.AdminDashboard", ["products" => $products]);
    // }

    public function create()
    {
        $statusCode = session('status_code', 200);
        return view("components.create", [
            "statusCode" => $statusCode
        ]);
    }
    // public function store(Request $request)
    // {
    //     // dd($request);
    //     // $request->validate([
    //     //     'name' => 'required',
    //     //     'description' => 'required',
    //     //     'mrp' => 'required|numeric',
    //     //     'price' => 'required|numeric',
    //     //     'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
    //     // ]);
    //     $product = new Product();
    //     $validation = $product->validate($request->all());
    //         if ($validation->fails()) {
    //             return redirect()->back()->withErrors($validation->errors());
    //         }
    //     $imageName = time() . '.' . $request->image->extension();
    //     $request->image->move(public_path('image'), $imageName);

    //     $product->image = $imageName;
    //     $product->name = $request->name;
    //     $product->description = $request->description;
    //     $product->price = $request->price;
    //     $product->mrp = $request->mrp;
    //     $product->save();
    //     return redirect('/dashboard')->with('success', 'Product details added successfully...'); 
    // }
    
    public function store(Request $request)
    {
        $result = Product::storeProduct($request);
        // dd($result);
        if ($result['success']) {
            // Store the status code in the session
            session(['status_code' => $result['status']]);
            return redirect('/admin/dashboard')
                ->with('success', $result['message']);
        } else {
            // Store the status code in the session
            session(['status_code' => $result['status']]);

            if (isset($result['errors'])) {
                return redirect()->back()
                    ->withErrors($result['errors'])
                    ->withInput();
            } else {
                return redirect()->back()
                    ->with('error', $result['message'])
                    ->withInput();
            }
        }
    }
    
    public function show($id)
    {
        // Attempt to find the product by its ID
        $product = Product::find($id);

        // Return 404 if the product is not found
        if (!$product) {
            return abort(404, 'Product not found');
        }

        // Return the view with the product data
        return view('components.AdminView', ['product' => $product]);
    }


    public function edit($id)
    {
        $product = Product::edit($id);
        // Check if the product exists
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return view('components.edit', ['product' => $product]);
    }


    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        //     'mrp' => 'required|numeric',
        //     'price' => 'required|numeric',
        //     'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        // ]);
        $product = Product::find($id);

        // if (isset($request->image)) {
        //     $imageName = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('image'), $imageName);
        //     $product->image = $imageName;
        // }

        // $product->name = $request->name;
        // $product->description = $request->description;
        // $product->price = $request->price;
        // $product->mrp = $request->mrp;
        // $product->save();
        try {
            $product->updateProduct($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
        return redirect('/admin/dashboard')->with('success', 'Product details updated successfully...');

    }

    // public function destroy($id){
    //     // $product = Product::where('id', $id)->first();
    //     // $product->delete();
    //     $product = Product::destroy($id);
    //     return back()->with('success','Product deleted successfully');
    // }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Product deleted successfully');
    }

    public function trashed()
    {
        $trashedProducts = Product::onlyTrashed()->paginate(5);
        return view('components.TrashedProducts', ['products' => $trashedProducts]);
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return back()->with('success', 'Product restored successfully');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();

        return back()->with('success', 'Product permanently deleted');
    }

    public function adminCreatedProducts()
    {
        // Retrieve products with their corresponding admins and order them
        $productsWithAdmin = Product::getProductsWithAdmins();

        // Pass the products data to the view
        return view('components.productDetails', compact('productsWithAdmin'));
    }

    // Method to handle direct URL search parameter
    public function directSearch(string $search)
    {
        // dd($search);
        // Search for products with the search term
        $products = Product::where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->get();

        return view('components.search', compact('products', 'search'));
    }

      // Method to handle search input from a form or query string
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for products with the search term
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        return view('components.search', compact('products', 'query'));
    }
    

}
