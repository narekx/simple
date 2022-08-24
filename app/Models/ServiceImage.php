<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'service_id', 'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service ()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return string
     */
    public function imagePath ()
    {
        return 'uploads' . DIRECTORY_SEPARATOR . 'services';
    }

    /**
     * @return string
     */
    public function getImagePathAttribute ()
    {
        $image = $this->name ?? '';
        return 'uploads/services/' . $image;
    }
}
