<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{   

    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'description', 'mrp', 'price', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function validateStore(array $data){
         return  Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        
    }

    public static function storeProduct($request)
    {
        $validation = self::validateStore($request->all());
        
        if ($validation->fails()) {
            return ['success' => false, 'errors' => $validation->errors()->toArray(), 'status' => 400];
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('image'), $imageName);

        $product = new self();
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->mrp = $request->mrp;
        $product['user_id'] = auth()->id();

        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin') {
            $product->created_by = Auth::guard('admin')->user()->id;
            $product->save();
            return ['success' => true, 'message' => 'Product details added successfully.', 'status' => 302];
        } else {
            return ['success' => false, 'message' => 'Only admin users can create products.', 'status' => 403];

        }
    }

    public static function show($id){
        $product = Product::where('id', $id)->first();
        return $product;
    }
    public static function edit($id){
        $product = Product::where('id', $id)->first();
        return $product;
    }

    public function validateProductData(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);
    }

    public function updateProduct(array $data)
    {
        $validator = $this->validateProductData($data);
    
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->id === $this->created_by) {
            $this->name = $data['name'];
            $this->description = $data['description'];
            $this->mrp = $data['mrp'];
            $this->price = $data['price'];
    
            if (isset($data['image'])) {
                $imageName = time() . '.' . $data['image']->extension();
                $data['image']->move(public_path('image'), $imageName);
                $this->image = $imageName;
            }
    
            $this->save();
        } else {
            throw new \Exception('Only the admin who created the product can edit it.');
        }
    }

    public static function deleteProduct($id){
        $product = Product::where('id', $id)->first();
        $product->delete();
    }

    public function createdByAdmin(){
        return $this->belongsTo(User::class,'created_by');
    }

    // Define a custom method to retrieve products with admins and order them by created date
    public static function getProductsWithAdmins()
    {
        $productsWithAdmin = static::select('products.*', 'users.name as admin_name','users.created_at as created_at', 'users.updated_at as updated_at')
        ->join('users', 'products.created_by', '=', 'users.id')
        ->orderBy('products.name', 'desc')
        ->get();
    
        return $productsWithAdmin;
    }
    
}
