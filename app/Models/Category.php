<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

/**
 * Class Category
 * @package App\Models
 * @params name
 * @params order
 */
class Category extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'order', 'slug', 'image', 'icon', 'status'
    ];

    /**
     * @param null $id
     * @return array
     */
    public static function rules($id = null)
    {
        return [
            'name'   => 'required|max:50|min:2',
            'slug' => [
                'required',
                'max:50',
                'min:2',
                Rule::unique('categories')->ignore($id)
            ],
            'order'  => 'integer',
            'status' => 'required',
            'icon' => 'max:255',
//            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png'
        ];
    }

    /**
     * @param $sort_array
     */
    public function sortTable($sort_array) {
        foreach ($sort_array as $key => $sort) {
            $sort = self::find($sort);
            $sort->order = $key;
            $sort->save();
        }
    }

    /**
     * @return string
     */
    public function imagePath ()
    {
        return 'uploads' . DIRECTORY_SEPARATOR . 'categories';
    }

    /**
     * @return string
     */
    public function getImagePathAttribute ()
    {
        $image = $this->image ?? '';
        return 'uploads/categories/' . $image;
    }

    /**
     * @return string
     */
    public function getIconPathAttribute ()
    {
        $icon = $this->icon ?? '';
        return 'static/img/icons/' . $icon . '.svg';
    }
}
