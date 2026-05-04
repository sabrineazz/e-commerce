<?php

namespace App\Strategies\cart\impl;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Strategies\cart\CartInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    private const CART_SESSION_KEY = 'cart';

    public function __construct(private RequestStack $requestStack)
    {
    }

    public function add(CartItem $item, Cart $cart): Cart
    {
        foreach ($cart->getCartItems() as $existingItem) {
            if ($existingItem->getProduct()->getId() === $item->getProduct()->getId()) {
                
                $existingItem->setQuantity($existingItem->getQuantity() + $item->getQuantity());
                $this->saveCart($cart);
                return $cart;
            }
        }
        $cart->addCartItem($item);
        $this->saveCart($cart);

        return $cart;
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        foreach ($cart->getCartItems() as $existingItem) {
            if ($existingItem->getProduct()->getId() === $item->getProduct()->getId()) {
                $cart->removeCartItem($existingItem);
                break;
            }
        }

        $this->saveCart($cart);

        return $cart;
    }

    public function getCart(): Cart
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get(self::CART_SESSION_KEY);

        if (!$cart instanceof Cart) {
            $cart = new Cart();
            $this->saveCart($cart);
        }

        return $cart;
    }

    public function clearCart(string $identifier): Cart
    {
        $cart = new Cart();
        $this->saveCart($cart);

        return $cart;
    }


    private function saveCart(Cart $cart): void
    {
        $this->requestStack->getSession()->set(self::CART_SESSION_KEY, $cart);
    }
}