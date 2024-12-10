<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'phone_no',
        'no_of_people',
        'table_number',
        'booking_start_time',
        'booking_end_time',
    ];
}
