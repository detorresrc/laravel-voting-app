<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public static function getStatusCount()
    {
        return Idea::select('status_id', DB::raw('count(*) as count'))
            ->groupBy('status_id')
            ->pluck('count', 'status_id')
            ->toArray();
    }
}
