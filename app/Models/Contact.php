<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'country_code',
        'number'
    ];

    public function getContacts() {
        return $this->get();
    }
    public function people() {
        return $this->belongsTo(People::class);
    }
}
