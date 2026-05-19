<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait BelongsToInstitute
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootBelongsToInstitute()
    {
        // Automatically assign institute_id when creating a record
        static::creating(function ($model) {
            if (Auth::check() && Auth::user()->institute_id) {
                if (empty($model->institute_id)) {
                    $model->institute_id = Auth::user()->institute_id;
                }
            }
        });

        // Automatically filter queries by institute_id
        static::addGlobalScope('institute', function (Builder $builder) {
            $model = $builder->getModel();
            
            // If the model being queried is the User model, we must use Auth::hasUser()
            // to avoid infinite recursion when Laravel tries to authenticate the user.
            $isUserModel = get_class($model) === 'App\Models\User';

            if ($isUserModel) {
                if (Auth::hasUser() && Auth::user()->institute_id) {
                    $builder->where($builder->getQuery()->from . '.institute_id', Auth::user()->institute_id);
                }
            } else {
                if (Auth::check() && Auth::user()->institute_id) {
                    $builder->where($builder->getQuery()->from . '.institute_id', Auth::user()->institute_id);
                }
            }
        });
    }
}
