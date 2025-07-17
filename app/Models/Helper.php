<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Image;
use Str;
use Validator;
use Verot\Upload\Upload;

class Helper
{

    public static function store($data, $path, $name, $config = NULL, $options = [])
    {
        $options = array_merge(["update" => FALSE, "full_path" => false, "clean" => true], $options);
        if (!$options['full_path']) $path = "uploads/$path/";
        $handle = new upload($data);
        if ($handle->uploaded) {
            $handle->file_new_name_body = $name;
            $handle->dir_auto_create = TRUE;
            $handle->mime_check = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = !$options['update'] ? array_search($handle->file_src_mime, $handle->mime_types) : FALSE;
            if ($config && is_array($config)) {
                foreach ($config as $key => $value) {
                    $handle->{$key} = $value;
                }
            }
            $return_content = $handle->process();
            if ($handle->processed) {
                Storage::put($path . $handle->file_dst_name, $return_content);
                if ($options['clean']) $handle->clean();
                return $handle->file_dst_name;
            } else {
                throw new Error("Error Processing Request", $handle->error);
            }
        }
    }

    public static function upload($data, $path, $name, $config = [], $options = [])
    {
        $generated_file_name = \Str::random(20) . "-" . Carbon::now()->timestamp;
        $name = $name ?? $generated_file_name . '.png';

        $options = array_merge(["update" => FALSE, "full_path" => false, "clean" => true], $options);
        $config = array_merge(["image_x" => null, "image_y" => null], $config);

        if (!$options['full_path']) $path = "uploads/$path/"; //supports s3,local

        $file_name = ($name ?? $generated_file_name) . '.png';
        if ($options['update']) {
            $file_name = $name ?? $generated_file_name . '.png';
            // if (Storage::exists("uploads/$path/" . $file_name)) {
            //     Storage::delete("uploads/$path/" . $file_name);
            // }
        }

        $rules = array('image' => 'required|image');
        $validator = Validator::make(['image' => $data], $rules);

        if ($validator->passes()) {
            $data->storeAs($path, $file_name);
        } else {
            Storage::putFileAs($path, $data, $file_name);
        }

        return $file_name;
    }
}