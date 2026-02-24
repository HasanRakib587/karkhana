<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    const COOKIE_NAME = 'cart_items';
    const COOKIE_MINUTES = 60 * 24 * 30; // 30 days

    /**
     * Add an item to the cart.
     * If already exists, increment quantity.
     */
    public static function addItemToCart($product_id, $quantity = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_key = self::findItemKey($cart_items, $product_id);

        if ($existing_key !== null) {
            // Increment quantity
            $cart_items[$existing_key]['quantity'] += $quantity;
            $cart_items[$existing_key]['total_amount'] = 
                $cart_items[$existing_key]['quantity'] * $cart_items[$existing_key]['unit_amount'];
        } else {
            // Add new item
            $product = Product::find($product_id, ['id', 'name', 'price', 'images']);
            if (!$product) return count($cart_items);

            $cart_items[] = [
                'product_id'   => $product->id,
                'name'         => $product->name,
                'image'        => $product->images[0] ?? null,
                'quantity'     => $quantity,
                'unit_amount'  => $product->price,
                'total_amount' => $product->price * $quantity,
            ];
        }

        self::saveCartToCookie($cart_items);
        return count($cart_items);
    }

    /**
     * Remove an item from the cart
     */
    public static function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        $key = self::findItemKey($cart_items, $product_id);

        if ($key !== null) {
            unset($cart_items[$key]);
            $cart_items = array_values($cart_items); // reindex
        }

        self::saveCartToCookie($cart_items);
        return $cart_items;
    }

    /**
     * Increment quantity for an item
     */
    public static function incrementQuantity($product_id, $amount = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $key = self::findItemKey($cart_items, $product_id);

        if ($key !== null) {
            $cart_items[$key]['quantity'] += $amount;
            $cart_items[$key]['total_amount'] = 
                $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
        }

        self::saveCartToCookie($cart_items);
        return $cart_items;
    }

    /**
     * Decrement quantity for an item
     */
    public static function decrementQuantity($product_id, $amount = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $key = self::findItemKey($cart_items, $product_id);

        if ($key !== null) {
            $cart_items[$key]['quantity'] -= $amount;
            if ($cart_items[$key]['quantity'] < 1) {
                // Remove item if quantity < 1
                unset($cart_items[$key]);
                $cart_items = array_values($cart_items);
            } else {
                $cart_items[$key]['total_amount'] = 
                    $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }

        self::saveCartToCookie($cart_items);
        return $cart_items;
    }

    /**
     * Clear entire cart
     */
    public static function clearCart()
    {
        Cookie::queue(Cookie::forget(self::COOKIE_NAME));
    }

    /**
     * Get all items from cart
     */
    public static function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get(self::COOKIE_NAME), true);
        return $cart_items ?? [];
    }

    /**
     * Calculate grand total
     */
    public static function calculateGrandTotal($cart_items = null)
    {
        $cart_items = $cart_items ?? self::getCartItemsFromCookie();
        return array_sum(array_column($cart_items, 'total_amount'));
    }

    /**
     * Private: save cart to cookie
     */
    private static function saveCartToCookie(array $cart_items)
    {
        Cookie::queue(self::COOKIE_NAME, json_encode($cart_items), self::COOKIE_MINUTES);
    }

    /**
     * Private: find item index in cart array
     */
    private static function findItemKey(array $cart_items, $product_id)
    {
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                return $key;
            }
        }
        return null;
    }
}
