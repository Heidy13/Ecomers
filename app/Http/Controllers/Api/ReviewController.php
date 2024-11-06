<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        try {
            $review = Review::create([
                'comment' => $request -> comment,
                'qualification' => $request -> qualification,
                'date' => now(),
                'id_user' => $request -> id_user,
                'id_product' => $request -> id_product,
                'id_ability' => $request -> id_ability
            ]);

            return response()->json(['message' => 'Review create successfully']);
            
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }
    }

    public function review_product($id)
    {
       try {

        $review_product = Review::where('id_product', $id)->get();
        return response()->json($review_product);


       } catch (Exception $e) {
        return response()->json(['error' => 'An error ocurrerd: '.$e->getMessage() ]);
       }
    }

    public function update (Request $request, $id) {
        try {

            $review = Review::find($id);
            if (!$review) {
                return response()->json(['error' => 'Review not found']);
            }

            $review ->update([
                'comment' => $request -> comment,
                'qualification' => $request -> qualification
            ]);

            return response()->json(['message' => 'Review update successfully']);
            
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {

            $review = Review::find($id);

            $review -> delete();

            return response()->json(['message' => 'Review delete successfully']);

        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: '.$e ->getMessage()]);
        }
    }
}
