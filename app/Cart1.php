<?php

namespace App;

class Cart1
{
    public $items = null;
    public $totalQty = 0;
    public $name = null;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
    	if ($oldCart) {
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;
            $this->name = $oldCart->name;
    	}
    }

    public function add($item, $id){
    	$storedItem = ['qty' => 0,'name' => $item->name, 'price' => $item->price,'item'=> $item];
    	if($this->items) {
    		if (array_key_exists($id, $this->items)){
    			$storedItem = $this->items[$id];
    		}
    	}
    	$storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
    	$this->items[$id] = $storedItem;
    	$this->totalQty++;
    	$this->totalPrice += $item->price;
        $this->name = $item->name;
    }

}