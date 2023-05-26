<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email'
    ];

    public function getAllNotDeletedPeoples() {
        return $this->withoutTrashed()->get();
    }
    public function getDetails($id) {
        return $this->find($id);
    }
    public function contacts() {
        return $this->hasMany(Contact::class);
    }
}
