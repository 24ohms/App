<?php


namespace App\Services;


use App\Cart;
use Exception;

class CartService
{
    public function addToCart (int $user_id, int $book_id) {
        try {
            $cart = Cart::where(['user_id'=>$user_id,'book_id'=>$book_id]);
            if($cart) {
                return [
                    'success' => false,
                    'message' => __('Book already exits in cart')
                ];
            }
            Cart::create([
                'user_id' => $user_id,
                'book_id' => $book_id
            ]);

            return [
                'success' => true,
                'message' => __('Book has been added to cart')
            ];
        } catch (Exception $e) {
            return [
                'success' => true,
                'message' => __('Failed to add book to cart')
            ];
        }
    }


    public function removeFromCart (int $book_id) {
        try {
            $book = Cart::where('book_id',$book_id)->delete();
            if(!$book) {
                return [
                    'success' => false,
                    'message' => __('Book not found in cart')
                ];
            }
            return [
                'success' => true,
                'message' => __('Book has been remove from cart')
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => __('Failed to remove book from cart')
            ];
        }
    }
}
