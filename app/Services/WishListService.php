<?php


namespace App\Services;


use App\WishList;

class WishListService
{
    /**
     * @param int $user_id
     * @param $book_id
     * @return array
     */
    public function addToWishList (int $user_id, $book_id) :array {
        try {
            $wishList = WishList::where('user_id',$user_id)->update([
                'book_id' => $book_id,
            ]);
            if (!$wishList) {
               WishList::create([
                   'user_id' => $user_id,
                   'book_id' => $book_id,
               ]);
            }
            return [
                'success' => true,
                'message' => __('Wish list has been updated')
            ];
        } catch (\Exception $e) {
            return [
                'success' => true,
                'message' => __('Something went wrong')
            ];
        }
    }

    /**
     * @param int $book_id
     * @return array
     */
    public  function removeFromWishList (int $book_id) : array {
        try {
            $wishList = WishList::find($book_id)->delete();
            if (!$wishList) {
                return [
                    'success' => false,
                    'message' => __('Wish List not found')
                ];
            }
            return [
                'success' => true,
                'message' => __('Book removed from wish list')
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => __('Failed to remove book from wish list')
            ];
        }
    }
}