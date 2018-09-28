<?php

namespace Arane\Sharepoint\Services\Handlers;

use Arane\Base\Models\Entities\User;
use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Base\Services\Handlers\SystemService;
use Arane\File\Services\Handlers\FileService;
use Arane\Sharepoint\Events\SharepointCopied;
use Arane\Sharepoint\Events\SharepointDeleted;
use Arane\Sharepoint\Events\SharepointMoved;
use Arane\Sharepoint\Events\SharepointRestored;
use Arane\Sharepoint\Events\SharepointShared;
use Arane\Sharepoint\Events\SharepointUnshared;
use Arane\Sharepoint\Events\SharepointUpdated;
use Arane\Sharepoint\Models\Entities\Sharepoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Event;

/**
 * Class SharepointService
 *
 * @package Arane\Sharepoint\Services\Handlers
 */
class SharepointService extends BaseModelService {
    
    /**
     * @var SystemService
     */
    protected $systemService;
    /**
     * @var FileService
     */
    protected $fileService;
    
    /**
     * Implements SharepointService constructor
     *
     * @param SystemService $systemService
     * @param FileService   $fileService
     */
    public function __construct(SystemService $systemService, FileService $fileService) {
        parent::__construct();
        
        $this->systemService = $systemService;
        $this->fileService = $fileService;
    }
    
    /**
     * Defines SharepointService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return Sharepoint::class;
    }
    
    /**
     * Upload (create) new sharepoint file from file content input
     *
     * @param array $attributes
     * @param       $content
     * @param int   $base64
     *
     * @return mixed
     */
    public function upload($attributes, $content, $base64 = false) {
        
        $attributes['owner_id'] = auth()->id();
        
        $file = $this->fileService->create($attributes, $content, $base64);
        
        isset($attributes['public']) ?: $attributes['public'] = 0;
        
        //store file data relate to sharepoint on sharepoints table
        return parent::create(['file_id' => $file->id, 'owner_id' => auth()->id(), 'virtual_path' => $this->cleanVirtualPath($attributes['virtual_path'], true), 'public' => $attributes['public']]);
    }
    
    /**
     * Updates sharepoint attributes
     *
     * @param int   $id
     * @param array $attributes
     *
     * @throws ModelNotFoundException
     * @return mixed|null
     */
    public function update($id, $attributes, $notFoundCreate = false, $noException = false) {
        
        $id = is_array($id) ? $id : [$id];
        
        $sharepoints = $this->model->whereIn('id', $id)->get();
        
        if (!$sharepoints->count()) {
            throw new ModelNotFoundException();
        }
        
        //Look for the specified resource
        
        $updated = 0;
        
        foreach ($sharepoints as $sharepoint) {
            
            if (isset($attributes['virtual_path'])) {
                parent::update($sharepoint->id, ['virtual_path' => $this->cleanVirtualPath($attributes['virtual_path'], true)]);
            }
            
            if (isset($attributes['name'])) {
                $this->fileService->update($sharepoint->file->id, ['name' => $attributes['name']]);
            }
            
            Event::fire(new SharepointUpdated($sharepoint));
            
            $updated++;
        }
        
        return $updated;
    }
    
    /**
     * Deletes sharepoint(s) softly or permanently
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id, $trashed = false) {
        
        $id = is_array($id) ? $id : [$id];
        
        if ($trashed) {
            $sharepoints = $this->model->onlyTrashed()->whereIn('id', $id)->get();
        } else {
            $sharepoints = $this->model->whereIn('id', $id)->get();
        }
        
        if (!$sharepoints->count()) {
            throw new ModelNotFoundException();
        }
        
        $deleted = 0;
        
        foreach ($sharepoints as $sharepoint) {
            
            //Check file is shared
            $sharedFiles = $this->model->shared()->getQuery()->where('id', $sharepoint->id)->get();
            
            //Delete all share relationships
            foreach ($sharedFiles as $sharedFile) {
                $sharepoint->detachUser($sharedFile->user->id);
            }
            
            //Soft Delete file
            if (!$trashed) {
                $this->model->where('id', $sharepoint->id)->update(['virtual_path' => '/trash/']);
            }
            //Delete from FileService
            $this->fileService->delete($sharepoint->file->id, $trashed);
            
            //Delete Sharepoint
            parent::delete($sharepoint->id, $trashed);
            
            $deleted++;
            
            Event::fire(new SharepointDeleted($sharepoint));
        }
        
        return $deleted;
    }
    
    /**
     * Restores sharepoint(s) from trash
     *
     * @param int   $id
     * @param array $attributes
     *
     * @return mixed
     * @throws \Exception
     */
    public function restore($id, $path = null) {
        
        $id = is_array($id) ? $id : [$id];
        
        $sharepoints = $this->model->onlyTrashed()->whereIn('id', $id)->get();
        
        if (!$sharepoints->count()) {
            throw new ModelNotFoundException();
        }
        
        $restored = 0;
        
        foreach ($sharepoints as $sharepoint) {
            
            parent::restore($sharepoint->id);
            
            $virtualPath = isset($path) ? $this->cleanVirtualPath($path, true) : $sharepoint->virtual_path;
            
            $this->model->where('id', $sharepoint->id)->update(['virtual_path' => $virtualPath]);
            
            //Restore file from filesystem
            $this->fileService->restore($sharepoint->file_id);
            
            Event::fire(new SharepointRestored($sharepoint));
            $restored++;
        }
        
        return $restored;
    }
    
    
    /**
     * @param int    $id
     * @param string $virtualPath
     * @param string $newName
     * @param bool   $public
     *
     * @return mixed
     * @throws \Exception
     */
    public function copy($id, $virtualPath = null, $newName = null, $public = false) {
        
        $sharepoint = $this->find($id);
        
        //Make a physical copy of the file on server
        $file = $this->fileService->copy($sharepoint->file->id, $sharepoint->file->path, $newName);
        
        $virtualPath = isset($virtualPath) ? $virtualPath : $sharepoint->virtual_path;
        
        //Store file data relate to sharepoint on sharepoints table
        $copied = parent::create(['file_id' => $file->id, 'owner_id' => auth()->id(), 'virtual_path' => $this->cleanVirtualPath($virtualPath, true), 'public' => $public]);
        
        Event::fire(new SharepointCopied($copied));
        
        return $copied;
    }
    
    /**
     * Moves file to new path with optional renaming
     *
     * @param int    $id
     * @param string $virtualPath
     * @param string $newName
     *
     * @return mixed
     * @throws \Exception
     */
    public function move($id, $virtualPath = null, $newName = null) {
        
        $sharepoint = $this->find($id);
        
        //Make a physical copy of the file on server
        $file = $this->fileService->move($sharepoint->file->id, $sharepoint->file->path, $newName);
        
        $virtualPath = isset($virtualPath) ? $virtualPath : $sharepoint->virtual_path;
        
        //Store file data relate to sharepoint on sharepoints table
        parent::update($sharepoint->id, ['file_id' => $file->id, 'virtual_path' => $this->cleanVirtualPath($virtualPath, true)]);
        
        $sharepoint = $this->find($sharepoint->id);
        
        Event::fire(new SharepointMoved($sharepoint));
        
        return $sharepoint;
    }
    
    /**
     * Returns download link for sharepoint
     *
     * @param Sharepoint $sharepoint
     *
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function download(Sharepoint $sharepoint) {
        
        //TODO: Return sharepoint link instead of object
        return $sharepoint;
    }
    
    
    /**
     * Returns directory sharepoint list
     *
     * @param      $user
     * @param      $path
     * @param bool $shared
     * @param bool $recursive
     * @return array
     */
    public function list($user_id, $path, $shared = false, $recursive = false) {
        
        $user = User::find($user_id);
        
        //TODO:Implementation using recursive parameter is pending
        $folders = collect();
        $files = collect();
        
        //Look for all files matching $path/something regular expression
        $query = ($shared) ? $this->model->sharedWith($user->id) : $this->model->ownedBy($user->id);
        if ($path !== '/') {
            $query->where('virtual_path', 'regexp', '^(' . $path . ')(/[-_0-9a-zA-Z]+)*$');
        }
        
        $sharepoints = $query->get();
        
        //Get file records and folder names
        foreach ($sharepoints as $sharepoint) {
            if ($sharepoint->file->id !== 0 && strcasecmp($sharepoint->virtual_path, $path) === 0) {
                
                $file = $sharepoint->toArray();
                $file['filename'] = $sharepoint->file->name;
                $file['type'] = $sharepoint->file->type;
                
                unset($file['file_id']);
                
                if ($shared) {
                    unset($file['sharepoint_id']);
                }
                
                $files->push($file);
            } else {
                $start = strlen($path) + (($path !== '/') ? 1 : 0);
                $name = substr($sharepoint->virtual_path, $start, strlen($sharepoint->virtual_path));
                $nameParts = explode('/', $name);
                $folders->push($nameParts[0]);
            }
        }
        
        return [
            //TODO:Improve replacing unique to search function within foreach loop
            'folders' => $folders->unique(),
            'files' => $files,
        ];
    }
    
    /**
     * Shares a sharepoint
     *
     * @param int        $id
     * @param array      $users
     * @param            $permission
     * @return mixed
     */
    public function share($id, $users, $permission) {
        
        $sharepoint = $this->find($id);
        
        $sharepoint->attachUser($users, $permission);
        
        $shared = $this->model->with('permissions')->find($id);
        
        Event::fire(new SharepointShared($shared));
        
        return $shared;
    }
    
    /**
     * Unshares sharepoint from a user
     *
     * @param int   $id
     * @param array $users
     * @return mixed
     */
    public function unshare($id, $users) {
        
        $sharepoint = $this->find($id);
        
        $sharepoint->detachUser($users);
        
        $unshared = $this->model->with('permissions')->find($id);
        
        Event::fire(new SharepointUnshared($unshared));
        
        return $unshared;
    }
    
    /**
     * Checks if user has permissions to access the sharepoint
     *
     * @param User       $user
     * @param Sharepoint $sharepoint
     * @param            $permission
     * @return bool
     */
    public function userHasPermission(User $user, Sharepoint $sharepoint, $permission) {
        
        switch ($permission) {
            
            case config('arane-sharepoint.ownership', 'o') :
                return $this->model->owner()->where('id', $sharepoint->id)->count();
                break;
            
            case config('arane-sharepoint.write', 'w') :
                return $this->model->sharedWith($user)->where('sharepoint_id', $sharepoint->id)->withPermission($permission)->count();
                break;
            
            case config('arane-sharepoint.read', 'r') :
                return $this->model->sharedWith($user)->where('sharepoint_id', $sharepoint->id)->withPermission($permission)->count();
                break;
            
            default:
                return false;
        }
    }
    
    //PRIVATE FUNCTIONS
    
    private function cleanVirtualPath($path, $root = false) {
        $basePath = $root ? '/' : '';
        
        return $basePath . trim($path, '/');
    }
}
