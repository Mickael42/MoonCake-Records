<?php

namespace App\Manager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionManager{
    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function create(int $id){

        $cart = $this->session->get('cart', "");
        $this->session->set('cart', $id);
        return $cart;
    }

    public function getCartSession(){
        $cart = $this->session->get('cart');
        return $cart;
    }

    public function delete(){
        $cart = $this->session->get('cart');
        unset($cart);
        $this->session->set('cart', '');
    }


}