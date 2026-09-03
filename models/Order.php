<?php

class Order
{
    public static function canCancel($status)
    {
        return $status === "Processing";
    }
}