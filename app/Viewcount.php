<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Viewcount
 * @property int $id
 * @property int $post_id
 * @property string $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewcount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Viewcount extends Model
{

    protected $table = 'viewcount';
    protected $fillable = ['post_id', 'ip'];


    static public function increase(Post $post, Request $request)
    {

        $viewCount = Viewcount::whereDate('created_at', Carbon::today())
            ->where('post_id', $post->id)->where('ip', $request->ip())->get();

        if (!$viewCount->count()) {
            Viewcount::create(['post_id' => $post->id, 'ip' => $request->ip()]);
        }
    }
}
