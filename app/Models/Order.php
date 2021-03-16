<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'order_id',
        'order_number',
        'order_date',
        'weight',
        'quantity', 
        'product',
        'shipping',
        'fulfilled',
        'delivery_contact_name',
        'delivery_addressline1',
        'delivery_addressline2',
        'delivery_post_code',
        'notification_sms',
        'notification_email',
    ];

   
}
