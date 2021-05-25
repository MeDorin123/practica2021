<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Collection;


/**
 * App\Models\Visitor
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $visited_date
 * @property string $visits
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at

 * @method static Builder|Visitor newModelQuery()
 * @method static Builder|Visitor newQuery()
 * @method static Builder|Visitor query()
 

 */


class Visitor extends Model
{
    use HasFactory;


        /** @var string */
    protected $table = 'visitors';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'user_id',
        'name',
        'visited_date',
        'visits'
     
    ];
}
