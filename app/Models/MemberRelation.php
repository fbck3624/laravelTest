<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * string $name
 */
class MemberRelation extends Model
{
    public $incrementing = false;
    protected $table = 'member_relation';
    public $timestamps = false;
    protected $delete = [];
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }

    public function Member()
    {
        return $this->hasOne(Member::class, 'id', 'liver_id');
    }

    public function Group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
