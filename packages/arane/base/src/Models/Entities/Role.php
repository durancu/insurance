<?php

namespace Arane\Base\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role.
 *
 * @package namespace Arane\Base\Models\Entities;
 */
class Role extends Model {
    use ModelTrait;
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'table_name', 'display_name'];
    
    protected $shown = ['id'];
    
    public function getShownAttribute(){
        return $this->shown;
    }
    
    public function users() {
    
        /* return $this->belongsToMany(User::class, 'user_roles');
           ->select('users' . '.*')
            ->union($this->hasMany(User::class))->getQuery();*/
        
        return $this->hasMany(User::class);
    }
    
    public function permissions() {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
    
}
