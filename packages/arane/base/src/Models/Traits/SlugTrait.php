<?php

namespace Arane\Base\Models\Traits;


trait SlugTrait {
    
    /**
     * @param     $slugStr
     * @return string
     */
    public function createSlug($model, $slugStr) {
        // Normalize the title
        $slug = str_slug($slugStr);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = self::getRelatedSlugs($model, $slug);
        // If we haven't used it before then we are all good.
        if (!in_array($slug, $allSlugs)) {
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 100; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!in_array($newSlug, $allSlugs)) {
                return $newSlug;
            }
        }
        
        return $slug . uniqid('-');
    }
    
    public function getRelatedSlugs($model, $slug) {
        $model = new $model;
        return $model->getModel()->withTrashed()->where('slug', 'like', $slug . '%')
            ->pluck('slug')->toArray();
    }
    
    
}