<?php

namespace Arane\Email\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Arane\Email\Events\EmailList\EmailListCreated;
use Arane\Email\Events\EmailList\EmailListUpdated;
use Arane\Email\Events\EmailList\EmailListDeleted;
use Arane\Email\Events\EmailList\EmailListRestored;


class EmailList extends Model {
    
    use SoftDeletes;
    use ModelTrait;
    
    protected $table = 'email_lists';
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['name', 'description', 'emails', 'slug'];
    
    protected $dispatchesEvents = [
        'created' => EmailListCreated::class,
        'updated'=> EmailListUpdated::class,
        'deleted' => EmailListDeleted::class,
        'restored' => EmailListRestored::class,
    ];
}
