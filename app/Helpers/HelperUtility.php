<?php

namespace App\Helpers;

class HelperUtility {

    public static function getBadge($status){
        
        return match ($status) {
            'pending'   => 'bg-warning',
            'paid' => 'bg-success',
            'failed' => 'bg-danger',
            'cancelled' => 'bg-danger',

            'new' => 'bg-info',
            'processing' => 'bg-warning',
            'shipped' => 'bg-success',
            'delivered' => 'bg-success',            
             default     => 'bg-secondary',
        };
    }
}