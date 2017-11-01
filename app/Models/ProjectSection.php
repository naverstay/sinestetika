<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \SleepingOwl\Admin\Traits\OrderableModel;
use \KodiComponents\Support\Upload;

class ProjectSection extends Model
{
    use OrderableModel, Upload;

    public $timestamps = false;

    protected $casts = [
        'video' => 'upload'
    ];

    public $fillable = ['project_id', 'type', 'data', 'visible', 'note'];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function getVideoPreviewAttribute() {
        $preview = mb_substr($this->video, 0, mb_strrpos($this->video, '.')+1 ) . 'jpg';

        if(is_file(public_path($preview))) {
            return asset($preview);
        }
        return null;
    }

    public function getImagesAttribute() {
        $images = array_values((array)@json_decode($this->image));

        if(sizeof($images) && $images[0] != '') {
            foreach($images as $k => $path) {
                if(is_file(public_path($path))) {
                    $info = pathinfo(public_path($path));

                    $images[$k] = [
                        'main' => $path,
                        'mobile' => $info['dirname'] . '/' . $info['filename'] . '_m.' . $info['extension'],
                        'retina' => $info['dirname'] . '/' . $info['filename'] . '_2x.' . $info['extension']
                    ];

                    $images[$k]['mobile'] = str_replace(public_path(), '', $images[$k]['mobile']);
                    $images[$k]['retina'] = str_replace(public_path(), '', $images[$k]['retina']);

                    if(! is_file($images[$k]['mobile'])) {
                        unset($images[$k]['mobile']);
                    }

                    if(! is_file($images[$k]['retina'])) {
                        unset($images[$k]['retina']);
                    }
                } else {
                    unset($images[$k]);
                }
            }
        }

        return $images;
    }
}