<?php

namespace Arane\Base\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSetting.
 *
 * @package namespace Arane\Base\Models\Entities;
 */
class MenuItem extends Model {
    use ModelTrait;

    protected $table = "admin_menu_items";

    protected $casts = [
        'children' => 'array',
        'roles' => 'array'
    ];

    protected $attributes = [
      'children'
    ];
    
    protected $shown = ['id','parent_id'];
    
    public function getShownAttribute(){
        return $this->shown;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'name', 'icon', 'path_name', 'roles', 'enabled', 'ajax_load'];

    public function getParentAttribute(){
        return $this->parent_id;
    }

    public function setParentAttribute($parent_id){
        $this->parent_id = $parent_id;
    }

    public function getChildrenAttribute(){
        return MenuItem::where('parent_id', $this->id)->get();
    }


}
