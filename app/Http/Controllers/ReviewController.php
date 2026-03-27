<?php

namespace App\Http\Controllers;

   use App\Models\Review;
use Illuminate\Http\Request;
class ReviewController extends Controller
{


public function index()
{
    $reviews = Review::all();
    return view('reviews.index', compact('reviews'));
}

public function store(Request $request)
{
    Review::create($request->all());
    return redirect()->back();
}

public function destroy(string $id)
{
    Review::destroy($id);
    return redirect()->back();
}
}
