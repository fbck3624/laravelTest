<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * string $name
 */
class Member extends Model
{
    public $incrementing = false;
    protected $table = 'liver';
    protected $delete = ['deleted_at'];
    protected $guarded = [];
    protected $fillable = ['name', 'birthday', 'color', 'photo', 'descript', 'active'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    use \App\Http\Traits\UsesUuid;
    use \App\Http\Traits\MyModelTrait;
    use SoftDeletes;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->created_by = 'system';
            $query->updated_by = 'system';
        });
    }

    public function MemberRelation()
    {
        return $this->hasOne(MemberRelation::class, 'liver_id', 'id');
    }
}
