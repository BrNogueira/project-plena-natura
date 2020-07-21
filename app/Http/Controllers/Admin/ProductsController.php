<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Brand;

class ProductsController extends Controller
{
    public function __construct(){
      $this->middleware("auth:admin");
    }

    public function index(){
      $data['products'] = Product::paginate(10);
      return view('admin.products.index', $data);
    }

    public function insertProductForm(){
      $data['categorys'] = Category::all();
      $data['brands'] = Brand::all();
      return view('admin.products.new', $data);
    }

    public function store(Request $request){
      $product = new Product;
      $product->name = $request->name;
      $slug = makeSlug($request->name);
      $checkProductBySlug = Product::where('slug', $slug)->get();
      if(count($checkProductBySlug)){
        $slug .= '-'.(count($checkProductBySlug) + 1);
      }
      $product->slug = $slug;
      $product->active = $request->active;
      $product->sku = $request->sku;
      $product->gtin = $request->gtin;
      $product->ncm = $request->ncm;
      $product->price = number_format(is_numeric($request->price) ? $request->price : 0.00, 2, '.', '');
      $product->real_price = number_format(is_numeric($request->real_price) ? $request->real_price : 0.00, 2, '.', '');
      $product->promotion_price = number_format(is_numeric($request->promotion_price) ? $request->promotion_price : 0.00, 2, '.', '');
      $product->weight = number_format(is_numeric($request->weight) ? $request->weight : 0.00 ,2, '.', '');
      $product->gross_weight = number_format(is_numeric($request->gross_weight) ? $request->gross_weight : 0.00 ,2, '.', '');
      $product->expires_at  = $request->expires_at;
      $product->condition = $request->condition;
      $product->width  = number_format(is_numeric($request->width) ? $request->width : 0.00 ,2, '.', '');
      $product->heigth = number_format(is_numeric($request->heigth) ? $request->heigth : 0.00 ,2, '.', '');
      $product->length = number_format(is_numeric($request->length) ? $request->length : 0.00 ,2, '.', '');
      $product->unity  = $request->unity;
      $product->brand_id = $request->brand;
      $product->category_id = $request->category;
      $product->stock = is_numeric($request->stock) ? $request->stock : 0 ;
      $product->description = $request->description ? $request->description : '';

      // Upload image
      // Upload images
      // Define o valor default para a variável que contém o nome da imagem
      $nameFile = '';

      dd($request);

      // Verifica se informou o arquivo e se é válido
      if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {

        // Define um aleatório para o arquivo baseado no timestamps atual
        $name = uniqid(date('HisYmd'));

        // Recupera a extensão do arquivo
        $extension = $request->thumbnail->extension();

        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";

        // Faz o upload:
        $upload = $request->thumbnail->storeAs('products', $nameFile);

        dd($upload);


        // Verifica se NÃO deu certo o upload (Redireciona de volta)
//            if ( !$upload )
//                return redirect()
//                    ->back()
//                    ->with('error', 'Falha ao fazer upload')
//                    ->withInput();

      }


      $product->thumbnail = $nameFile;

      if($product->save()){
        $data['success'] = true;
        $data['msg']     = 'Produto cadastrado com sucesso!';
        return redirect('/admin/produtos/')->with($data);
      }else{
        $data['msg']     = 'Erro ao tentar inserir produto';
        return redirect()->back()->withErrors($data);
      }

    }

    public function editProductForm($id){
      $data['product'] = Product::findOrFail($id);
      $data['categorys'] = Category::all();
      $data['brands'] = Brand::all();
      return view('admin.products.edit', $data);
    }

    public function edit(Request $request, $id){
      $product = Product::findOrFail($id);
      $product->name = $request->name;
      if($request->has("active")){
        $product->active = $request->active;
      }

      if($request->has("condition")){
        $product->condition = $request->condition;
      }


      if($request->has("unity")){
        $product->unity  = $request->unity;
      }

      if($request->has("brand")){
        $product->brand_id = $request->brand;
      }

      if($request->has("category")){
        $product->category_id = $request->category;
      }


      $product->sku = $request->sku;
      $product->gtin = $request->gtin;
      $product->ncm = $request->ncm;
      $product->price = number_format(is_numeric($request->price) ? $request->price : 0.00, 2, '.', '');
      $product->real_price = number_format(is_numeric($request->real_price) ? $request->real_price : 0.00, 2, '.', '');
      $product->promotion_price = number_format(is_numeric($request->promotion_price) ? $request->promotion_price : 0.00, 2, '.', '');
      $product->weight = number_format(is_numeric($request->weight) ? $request->weight : 0.00 ,2, '.', '');
      $product->gross_weight = number_format(is_numeric($request->gross_weight) ? $request->gross_weight : 0.00 ,2, '.', '');
      $product->expires_at  = $request->expires_at;
      $product->width  = number_format(is_numeric($request->width) ? $request->width : 0.00 ,2, '.', '');
      $product->heigth = number_format(is_numeric($request->heigth) ? $request->heigth : 0.00 ,2, '.', '');
      $product->length = number_format(is_numeric($request->length) ? $request->length : 0.00 ,2, '.', '');
      $product->stock = is_numeric($request->stock) ? $request->stock : 0 ;
      $product->description = $request->description ? $request->description : '';

      // Upload image
      // Upload images
      // Define o valor default para a variável que contém o nome da imagem
      $nameFile = '';

      // Verifica se informou o arquivo e se é válido
      if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {

        // Define um aleatório para o arquivo baseado no timestamps atual
        // $name = $request->thumbnail->hashName();
        $nameFile = $request->thumbnail->hashName();

        // Recupera a extensão do arquivo
        // $extension = $request->thumbnail->extension();

        // Define finalmente o nome
        // $nameFile = "{$name}.{$extension}";

        // Faz o upload:
        $upload = $request->thumbnail->storeAs('products', $nameFile);


        // Verifica se NÃO deu certo o upload (Redireciona de volta)
//            if ( !$upload )
//                return redirect()
//                    ->back()
//                    ->with('error', 'Falha ao fazer upload')
//                    ->withInput();

      }


      $product->thumbnail = $nameFile;

      if($product->save()){
        $data['success'] = true;
        $data['msg']     = 'Produto alterado com sucesso!';
        return redirect('/admin/produtos/')->with($data);
      }else{
        $data['msg']     = 'Erro ao tentar alterar produto';
        return redirect()->back()->withErrors($data);
      }

    }

    public function delete(Request $request){
      foreach ($request->products as $value) {
         Product::where('id', $value)->delete();
      }
      return redirect('/admin/produtos');
    }
}
