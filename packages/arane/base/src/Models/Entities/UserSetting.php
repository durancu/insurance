<?php

namespace Arane\Base\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSetting.
 *
 * @package namespace Arane\Base\Models\Entities;
 */
class UserSetting extends Model {
    use ModelTrait;

    protected $table = "user_settings";

    protected $casts = [
        'number_format' => 'array'
    ];
    
    protected $shown = ['id', 'user_id'];
    
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
    protected $fillable = ['user_id', 'locale', 'currency', 'timezone', 'date_format', 'time_format', 'number_format'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
