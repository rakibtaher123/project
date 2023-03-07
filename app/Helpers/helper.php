<?php

function cardArray(){
    $cardCollection = Cart::getContent();
    return $cardCollection->toArray();

}