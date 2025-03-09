<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
    public function store(Request $request, Product $product) {
        $request->validate([
            'content' => 'required|string|min:3',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'content' => $request->content,
        ]);

        return redirect()->route('products.show', $product)->with('success', 'Comentario agregado.');
    }

    public function destroy(Comment $comment) {
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'No puedes eliminar este comentario.');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Comentario eliminado.');
    }
}
