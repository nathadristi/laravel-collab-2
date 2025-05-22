<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        // Menggunakan scope
        $expensiveProducts = Product::expensive()->get();

        // Menggunakan query builder
        $averagePrice = Product::averagePrice();

        return view('products.index', compact('products','expensiveProducts','averagePrice'));

        // // Query Mengambil produk dengan harga di atas 1 juta dan diurutkan dari harga tertinggi
        // $expensiveProducts = Product::where('price', '>', 1000000)
        //                             ->orderBy('price', 'desc')
        //                             ->get();
    
        // // Query Builder untuk mendapatkan rata-rata harga produk
        // $averagePrice = DB::table('products')->avg('price');

	    // Tambahkan juga variabel ‘averagePrice’ di compact
	    // compact('products', ‘expensiveProducts’, ‘averagePrice’)

        // return view('products.index', compact('products','expensiveProducts','averagePrice'));

    }

        // Tampilkan form tambah produk
        public function create()
    {
            return view('products.create');
    }
    
        // Simpan produk baru ke database
        public function store(Request $request)
    {
            $request->validate([
                'name' => 'required',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
            ]);
    
            Product::create($request->all());
    
            return redirect('/products')->with('success', 'Product added successfully!');
    }    

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

      // Tampilkan form edit
      public function edit($id)
    {
          $product = Product::findOrFail($id);
          return view('products.edit', compact('product'));
    }
  
      // Simpan perubahan produk
      public function update(Request $request, $id)
      {
          $request->validate([
              'name' => 'required',
              'description' => 'nullable|string',
              'price' => 'required|numeric',
              'stock' => 'required|integer',
          ]);
  
          $product = Product::findOrFail($id);
          $product->update($request->all());
  
          return redirect('/products')->with('success', 'Product updated successfully!');
      }  

          // Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Product deleted successfully!');
    }
    
}

