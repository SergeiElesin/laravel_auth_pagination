<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use PhpParser\Builder;

/**
 *
 * Class Post
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Post extends Model
{
    use HasFactory;
//    protected $table = 'my_posts';
//    protected $primaryKey = 'post_id';
//    public $incrementing = false;
//    protected $keyType = 'string';
//    public $timestamps = 'false';

    /*protected $attributes = [
        'content' => 'Lorem ipsum...'

    ];*/

    protected $fillable = ['title', 'content', 'rubric_id'];

    public function rubric(){
        return $this->belongsTo(Rubric::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    /*public function getPostDate()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }*/

    public function getPostDate()
    {
        $formatter = new \IntlDateFormatter('ru_RU', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMM y');
        return $formatter->format(new \DateTime($this->created_at));
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }

    public function getTitleAttribute ($value)
    {
        return Str::upper($value);
    }


}
