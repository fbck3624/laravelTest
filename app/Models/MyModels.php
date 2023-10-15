<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $incrementing = false;
    protected $table = 'group';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'creation_at';
    const UPDATED_AT = 'updated_at';
}
