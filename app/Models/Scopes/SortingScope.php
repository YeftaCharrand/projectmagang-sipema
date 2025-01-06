<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class SortingScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->addSelect([
            'lowongan_perusahaan.*',
            DB::raw('(
              (
                CASE paket_id
                  WHEN 3 THEN 3
                  WHEN 2 THEN 2
                  WHEN 1 THEN 1
                END
                + 2 * EXP(-1 * (TIMESTAMPDIFF(HOUR, created_at, NOW()) / 24.0))
              )
              * EXP(
                  -(
                    CASE paket_id
                      WHEN 3 THEN 0.1
                      WHEN 2 THEN 0.2
                      WHEN 1 THEN 0.3
                    END
                  ) * (TIMESTAMPDIFF(HOUR, created_at, NOW()) / 24.0)
              )
            ) as score')
        ])->orderBy('score', 'DESC');
    }
}
