<?php

namespace Arane\Sharepoint\Models\Entities;

use Arane\Base\Models\Entities\User;
use Arane\Base\Models\Traits\ModelTrait;
use Arane\File\Models\Entities\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Arane\Sharepoint\Events\SharepointCopied;
use Arane\Sharepoint\Events\SharepointCreated;
use Arane\Sharepoint\Events\SharepointMoved;
use Arane\Sharepoint\Events\SharepointRestored;
use Arane\Sharepoint\Events\SharepointShared;
use Arane\Sharepoint\Events\SharepointDeleted;
use Arane\Sharepoint\Events\SharepointUnshared;
use Arane\Sharepoint\Events\SharepointUpdated;
use Illuminate\Database\Query\Builder;


/**
 * Class Sharepoint.
 *
 * @package namespace Arane\Sharepoint\Models\Entities;
 */
class Sharepoint extends Model {
    use SoftDeletes;
    use ModelTrait;
    
    /**
     * @var string
     */
    protected $table = 'sharepoints';
    
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * @var array
     */
    protected $fillable = ['file_id', 'owner_id', 'virtual_path'];
    
    protected $appends = ['full_path'];
    
    protected $shown = ['id', 'file_id', 'owner_id'];
    
    public function getShownAttribute(){
        return $this->shown;
    }
    
    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => SharepointCreated::class,
        'updated' => SharepointUpdated::class,
        'deleted' => SharepointDeleted::class,
        'restored' => SharepointRestored::class,
        'shared' => SharepointShared::class,
        'unshared' => SharepointUnshared::class,
        'copied' => SharepointCopied::class,
        'moved' => SharepointMoved::class,
    ];
    
    ////////////////////////////////////////////  MODEL  RELATIONSHIP FUNCTIONS   ////////////////////////////////////////
    
    /**
     * Returns sharepoint owner user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
    /**
     * Returns sharepoint physical file model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file() {
        return $this->belongsTo('Arane\File\Models\Entities\File', 'file_id');
    }
    
    /**
     * Returns sharepoint permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions() {
        return $this->hasMany('Arane\Sharepoint\Models\Entities\SharepointPermission');
    }
    
    /** Returns all users with access to this sharepoint
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grantedUsers() {
        return $this->belongsToMany(User::class, 'sharepoint_permission', 'sharepoint_id', 'user_id')->withPivot('permission')->withTimestamps();
    }
    
    ///////////////////////////////////////////  MODEL  LOCAL  SCOPES  ////////////////////////////////////////
    
    /**
     * Returns all sharepoint within an specific folder
     *
     * @param      $query
     * @param      $path
     * @param bool $shared
     * @param bool $recursive
     * @return mixed
     */
    public function scopeInFolder($query, $path, $shared = false, $recursive = false) {
        if (isset($recursive) && $recursive) {
            return $query->where('virtual_path', 'like', $path . '%');
        }
        
        return $query->where('virtual_path', 'like', $path);
    }
    
    /**
     * Returns all sharepoints of type file
     *
     * @param $query
     * @return mixed
     */
    public function scopeFiles($query) {
        return $query->where('file_id', '<>', 0);
    }
    
    /**
     * Returns all sharepoints of type folder
     *
     * @param $query
     * @return mixed
     */
    public function scopeFolders($query) {
        return $query->where('file_id', 0);
    }
    
    /**
     * Returns all sharepoints owned by specific user
     *
     * @param $query
     * @param $user
     * @return mixed
     */
    public function scopeOwnedBy($query, $user) {
        return $query->where('owner_id', $user);
    }
    
    /**
     * Returns all sharepoints which specific user has access to
     *
     * @param $query
     * @param $user
     * @return mixed
     */
    public function scopeOfUser($query, $user) {
        
        $user_id = (is_object($user)) ? $user->id : $user;
        
        //TODO:Enhance this question later
        
        $query->join('sharepoint_permission', 'sharepoints.id', '=', 'sharepoint_permission.sharepoint_id');
        
        $query->where(function ($query) use ($user_id) {
            $query->where('sharepoints.owner_id', $user_id);
            $query->orWhere('sharepoint_permission.user_id', $user_id);
        });
        
        return $query;
    }
    
    /**
     * Returns all shared sharepoints
     *
     * @param $query
     * @return mixed
     */
    public function scopeShared($query) {
        $query->join('sharepoint_permission', 'sharepoints.id', '=', 'sharepoint_permission.sharepoint_id');
        $query->where('sharepoint_permission.sharepoint_id', $this->id);
        
        return $query;
    }
    
    /**
     * Returns all shared sharepoints to an specific user
     *
     * @param $query
     * @param $user
     * @return mixed
     */
    public function scopeSharedWith($query, $user) {
        $query->join('sharepoint_permission', 'sharepoints.id', '=', 'sharepoint_permission.sharepoint_id');
        $query->where('sharepoint_permission.user_id', $user);
        
        return $query;
    }
    
    /**
     * Returns all sharepoint with an specific permission
     *
     * @param $query
     * @param $permission
     * @return mixed
     */
    public function scopeWithPermission($query, $permission) {
        $query->where('sharepoint_permission.permission', $permission);
        
        return $query;
    }
    
    ///////////////////////////////////////////  MODEL AUXILIARY FUNCTIONS  ////////////////////////////////////////
    
    /**
     * Assign user permission to the model
     *
     * @param $users
     * @param $permission
     * @return bool
     */
    public function attachUser($user_id, $permission) {
        $user_id = is_array($user_id) ? $user_id : [$user_id];
        $users = User::whereIn('id', $user_id)->get();
        
        if (!$users->count()) {
            throw new ModelNotFoundException("No user found with provided id");
        }
        
        foreach ($users as $user) {
            $grantedUser = $this->grantedUsers()->wherePivot('user_id', $user->id)->first();
            if (!isset($grantedUser)) {
                $this->grantedUsers()->attach($user->id, ['permission' => $permission]);
            } else {
                $grantedUser->pivot->permission = $permission;
                $grantedUser->pivot->save();
            }
        }
        
        return true;
    }
    
    /**
     * Remove user permission to the model
     *
     * @param $users
     * @return bool
     */
    public function detachUser($user_id) {
        $user_id = is_array($user_id) ? $user_id : [$user_id];
        $users = User::whereIn('id', $user_id)->get();
        
        if (!$users->count()) {
            throw new ModelNotFoundException("No user found with provided id");
        }
        
        foreach ($users as $user) {
            $grantedUser = $this->grantedUsers()->wherePivot('user_id', $user->id)->first();
            if (isset($grantedUser)) {
                $this->grantedUsers()->detach($user->id);
            }
        }
        
        return true;
    }
    
    /**
     * Returns if the model is a folder
     *
     * @return bool
     */
    public function isFolder() {
        return $this->file_id === 0;
    }
    
    /**
     * Returns if the model is a file
     *
     * @return bool
     */
    public function isFile() {
        return $this->file_id !== 0;
    }
    
    /**
     * Returns whether the model is within an specific folder
     *
     * @param      $folder_path
     * @param bool $shared
     * @param bool $recursive
     * @return bool
     */
    public function inFolder($folder_path, $shared = false, $recursive = false) {
        if (isset($recursive)) {
            return starts_with(strtolower($this->virtual_path), strtolower($folder_path));
        } else {
            return strcasecmp(strtolower($this->virtual_path), strtolower($folder_path)) == 0;
        }
    }
    
    /**
     * Returns whether the model is public or not
     *
     * @param $file_id
     * @return bool
     */
    public function isPublic($file_id) {
        return $this->where('file_id', $file_id)->where('permission', config('arane-sharepoint.read'))->count() === 0;
    }
    
    public function getFullPathAttribute() {
        //dd($this);
        $file = File::find($this->file_id)->toArray();
        
        return $this->virtual_path . '/' . $file['filename'];
    }
}
