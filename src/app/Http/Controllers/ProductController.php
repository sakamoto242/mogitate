<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index(Request $request)
{
    $query = Product::query();

    // 商品名で検索
    if ($request->filled('name')) {
        $query->where('name', 'LIKE', '%' . $request->name . '%');
    }

    // 価格で並び替え
    if ($request->sort === 'low') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort === 'high') {
        $query->orderBy('price', 'desc');
    }

    $products = $query->paginate(6); // 1ページに6件表示

    return view('products.index', compact('products'));
}

    public function show($id)
    {
        // 詳細画面用：季節情報も一緒に取得
        $product = Product::with('seasons')->findOrFail($id);
        return view('products.show', compact('product'));
    }
   public function create()
{
    $seasons = \App\Models\Season::all(); // 季節の選択肢を取得
    return view('products.create', compact('seasons'));
}

public function store(Request $request)
{
   $request->validate([
        'name' => 'required',
        'price' => 'required|integer|min:0|max:10000',
        'seasons' => 'required', // ここが seasons なので...
        'description' => 'required|max:120',
        'image' => 'required|mimes:png,jpeg',
    ], [
        'name.required' => '商品名を入力してください',
        'price.required' => '値段を入力してください',
        'price.integer' => '数値で入力してください',
        'price.min' => '0~10000円以内で入力してください',
        'price.max' => '0~10000円以内で入力してください',
        
        // ★ここを修正！ season ではなく seasons にします
        'seasons.required' => '季節を選択してください', 
        
        'description.required' => '商品説明を入力してください',
        'description.max' => '120文字以内で入力してください',
        'image.required' => '商品画像を登録してください',
        'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
    ]);
    // --- ここから下は既存の保存処理 ---
   $filename = $request->file('image')->getClientOriginalName();
    $request->file('image')->storeAs('public', $filename);

    $product = \App\Models\Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'image' => $filename,
        'description' => $request->description,
    ]);

    $product->seasons()->attach($request->seasons);

    return redirect()->route('product.index');
}
public function edit($id)
{
    $product = Product::with('seasons')->findOrFail($id);
    $seasons = \App\Models\Season::all();
    return view('products.edit', compact('product', 'seasons'));
}
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name'        => 'required',
        'price'       => 'required|integer|min:0|max:10000',
        'seasons'     => 'required', // ★ season から seasons に変更
        'description' => 'required|max:120',
        'image'       => 'required|mimes:png,jpeg',
    ],[
        'name.required'        => '商品名を入力してください',
        'price.required'       => '値段を入力してください',
        'price.integer'        => '数値で入力してください',
        'price.min'            => '0~10000円以内で入力してください',
        'price.max'            => '0~10000円以内で入力してください',
        'seasons.required'     => '季節を選択してください', // ★ ここも合わせる
        'description.required' => '商品説明を入力してください',
        'description.max'      => '120文字以内で入力してください',
        'image.required'       => '商品画像を登録してください',
        'image.mimes'          => '「.png」または「.jpeg」形式でアップロードしてください',
    ]);

    // 2. 基本情報の更新
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;

    // 3. 画像が新しくアップロードされた場合のみ差し替える
    if ($request->hasFile('image')) {
        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $filename);
        $product->image = $filename;
    }

    $product->save();

    // 4. 季節情報の更新（syncを使うと一気に入れ替えてくれます）
    $product->seasons()->sync($request->seasons);

    return redirect()->route('product.show', $product->id);
}
public function destroy($id)
{
    $product = Product::findOrFail($id);
    
    // 中間テーブル（seasonsとの紐付け）を先に解除してから削除
    $product->seasons()->detach();
    $product->delete();

    // 一覧画面にリダイレクト
    return redirect()->route('product.index');
}

}
