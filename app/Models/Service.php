<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Class Service
 * @package App\Models
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int $user_id
 * @property int $category_id
 * @property int $work_time_id
 * @mixin \Eloquent
 */
class Service extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'title', 'description', 'user_id', 'category_id', 'work_time_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images ()
    {
        return $this->hasMany(ServiceImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workTime ()
    {
        return $this->belongsTo(WorkTime::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function weekDays ()
    {
        return $this->belongsToMany(WeekDay::class, 'service_week_day', 'service_id', 'week_day_id');
    }

    /**
     * @param null $id
     * @return string[]
     */
    public static function rules($id = null)
    {
        return [
            'title'   => 'required|max:50|min:2',
            'description'  => 'required|max:500',
            'category_id' => 'required|integer',
            'work_time_id' => 'required|integer',
            'images.*' => 'image|mimes:jpg,jpeg,png',
            'week_days' => 'required',
            'week_days.*' => 'integer'
        ];
    }

    /**
     * @return string
     */
    public function getLimitedDescriptionAttribute ()
    {
        return Str::limit($this->description, 60, '...');
    }
}
