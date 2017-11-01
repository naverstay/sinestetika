<?php

function makeProjectThumbs($file, $path, $filename, $settings) {
    // info
    $full_path = public_path($path) . '/';
    $info = pathinfo($full_path . $filename);
    $img = \Image::make($file->path());
    $width = $img->width();

    $main_path = $full_path . $info['filename'] . '.' . $info['extension'];
    $retina_path = $full_path . $info['filename'] . '_2x.' . $info['extension'];
    $mobile_path = $full_path . $info['filename'] . '_m.' . $info['extension'];

    if($img->mime() == 'image/gif') {
        $coalesce_path = $full_path . $info['filename'] . '_coalesce.' . $info['extension'];

        set_time_limit(600);
        copy($file->path(), $coalesce_path);

        // common width (main)
        exec('gifsicle --resize-fit 1160x < ' . escapeshellarg($coalesce_path) . ' > ' . escapeshellarg($main_path));
        if ($width > 1160) {
            exec('gifsicle --resize-fit 2320x < ' . escapeshellarg($coalesce_path) . ' > ' . escapeshellarg($retina_path));
        }
        exec('gifsicle --resize-fit 560x < ' . escapeshellarg($coalesce_path) . ' > ' . escapeshellarg($mobile_path));

        @unlink($coalesce_path);
    } else {
        // common width (main)
        $img->resize(1160, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($main_path);

        // retina
        if ($width > 1160) {
            $img->resize(2320, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($retina_path);
        }

        // mobile & min
        $img->resize(560, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($mobile_path);
    }

    return ['path' => $path . '/' . $filename, 'value' => $main_path];
}

function is_ajax() {
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }

    return false;
}