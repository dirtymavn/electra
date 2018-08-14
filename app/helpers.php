<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

if (!function_exists('user_info')) {
    /**
     * Get logged user info.
     *
     * @param  string $column
     * @return mixed
     */
    function user_info($column = null)
    {
        if ($user = Sentinel::check()) {
            if (is_null($column)) {
                return $user;
            }

            if ('full_name' == $column) {
                return user_info('first_name') . ' ' . user_info('last_name');
            }

            if ('role' == $column) {
                return user_info()->roles[0];
            }

            if ('company' == $column) {
                if (@user_info()->company->name) {
                    return user_info()->company->name;
                } else {
                    return env('APP_NAME');
                }
            }

            return $user->{$column};
        }

        return null;
    }
}

if (!function_exists('link_to_avatar')) {
    /**
     * Generates link to avatar.
     *
     * @param  null|string $path
     * @return string
     */
    function link_to_avatar($path = null)
    {
        if (is_null($path) || !file_exists($path)) {
            return url('themes/img/avatar1.jpg');
        }

        return get_file($path, 'thumbnail');
    }
}

function host()
{
    $host = env('APP_URL');
    return $host;
}

function getUserIP()
{
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

function visitorInfo($ip = null, $purpose = "location", $deep_detect = true)
{
    $output = null;
    if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }

            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }

        }
    }
    $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), null, strtolower(trim($purpose)));
    $support = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America",
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city" => @$ipdat->geoplugin_city,
                        "state" => @$ipdat->geoplugin_regionName,
                        "country" => @$ipdat->geoplugin_countryName,
                        "country_code" => @$ipdat->geoplugin_countryCode,
                        "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode,
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1) {
                        $address[] = $ipdat->geoplugin_regionName;
                    }

                    if (@strlen($ipdat->geoplugin_city) >= 1) {
                        $address[] = $ipdat->geoplugin_city;
                    }

                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

if (!function_exists('upload_file')) {
    function upload_file($data, $filepath = 'uploads/', $filetype = 'image', $type = 'public')
    {
        if (!empty($data) && $data->isValid()) {
            $fileExtension = strtolower($data->getClientOriginalExtension());
            $fileName = $data->getClientOriginalName();
            $newFilename = rand(1, 999) . '-' . strtolower(str_replace(' ', '_', $fileName));

            if (!File::exists($filepath)) {
                File::makeDirectory($filepath, $mode = 0777, true, true);
            }

            if ($filetype == 'image') {
                $file = Image::make($data);
                $file->save($filepath . $newFilename);
                $compressedImage = compress_image($filepath . $newFilename);
                $imageThumbnail = image_thumbnail($filepath . $newFilename);
            } else {
                $file = $data->move($filepath, $newFilename);
                $compressedImage = '';
                $imageThumbnail = '';
            }
            $result['original'] = $filepath . $newFilename;
            $result['standard'] = $compressedImage;
            $result['thumbnail'] = $imageThumbnail;

            return $result;
        }

        return '';
    }
}

if (!function_exists('get_file')) {
    function get_file($path, $preview = 'compressed', $type = 'public')
    {
        if (!$path) {
            return 'http://www.novelupdates.com/img/noimagefound.jpg';
        }
        // $path_default = 'assets/frontend/images/yamaha_default.jpg';
        // if(! File::exists($path)) {
        //     return URL::to($path_default);
        // }

        if ($type == 'public') {
            if ($preview == 'thumbnail') {
                return URL::to(dirname($path) . '/thumb/' . basename($path));
            } else {
                return URL::to($path);
            }

        } else {
            //storage path
        }
    }
}

if (!function_exists('delete_file')) {
    function delete_file($path, $type = 'public')
    {
        if ($type == 'public') {
            $dirname = dirname($path);
            $filename = basename($path);

            if (file_exists(public_path() . '/' . $path)) {
                File::delete($path); // original
            }

            if (file_exists(public_path() . '/' . $dirname . '/compressed/' . $filename)) {
                File::delete($dirname . '/compressed/' . $filename);
            }

            if (file_exists(public_path() . '/' . $dirname . '/thumb/' . $filename)) {
                File::delete($dirname . '/thumb/' . $filename);
            }
        } else {
            if (Storage::has($path)) {
                return Storage::delete($path);
            }
        }
    }
}

if (!function_exists('compress_image')) {
    function compress_image($path, $width = 1366, $type = 'public')
    {
        if ($type == 'public') {
            $thumb_path = public_path() . '/' . dirname($path) . '/compressed/';
            list($img_width, $img_height) = getimagesize(public_path() . '/' . $path);

            if ($img_width < $width) {
                $width = $img_width;
            }

            if (!File::exists($thumb_path)) {
                File::makeDirectory($thumb_path, $mode = 0777, true, true);
            }

            $img = Image::make(public_path() . '/' . $path);
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumb_path . basename($path), 20);

            return dirname($path) . '/compressed/' . basename($path);
        } else {
            //storage path
        }
    }
}

if (!function_exists('image_thumbnail')) {
    function image_thumbnail($path, $width = 200, $type = 'public')
    {
        if ($type == 'public') {
            $thumb_path = public_path() . '/' . dirname($path) . '/thumb/';
            list($img_width, $img_height) = getimagesize(public_path() . '/' . $path);

            if ($img_width < $width) {
                $width = $img_width;
            }

            if (!File::exists($thumb_path)) {
                File::makeDirectory($thumb_path, $mode = 0777, true, true);
            }

            $img = Image::make(public_path() . '/' . $path);
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($thumb_path . basename($path), 60);

            return dirname($path) . '/thumb/' . basename($path);
        } else {
            //storage path
        }
    }
}

if (!function_exists('datatables')) {
    /**
     * Shortcut for Datatables::of().
     *
     * @param  mixed $builder
     * @return mixed
     */
    function datatables($builder)
    {
        return Datatables::of($builder);
    }
}

if (!function_exists('errorException')) {
    /**
     * Shortcut for return error excection.
     *
     * @param  mixed $builder
     * @return mixed
     */
    function errorException($error)
    {
        return response()->json([
            'result' => 'Error',
            'message' => $error->getMessage(),
            'file' => $error->getFile(),
            'line' => $error->getLine(),
        ], 400);
    }
}

if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($ptime)
    {
        $etime = time() - strtotime($ptime);

        if ($etime < 1) {
            return '0 seconds';
        }

        $a = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second',
        );
        $a_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds',
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }
}

if (!function_exists('currency')) {
    function currency($value, $option = null)
    {
        if ($option == null) {
            return 'Rp. ' . number_format($value, 0, '.', '.');
        } else {
            return number_format($value, 0, '.', '.');
        }
    }
}

if (!function_exists('sessionFlash')) {
    function sessionFlash($message, $type)
    {
        session()->put('notification', [
            'message' => $message,
            'alert-type' => $type,
        ]);
    }
}

if (!function_exists('wew')) {
    function wew($data)
    {
        echo "<pre>";
        print_r($data);die();
    }
}

 function randomString( $length = 6 )
 {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $number = '0123456789';
    $charactersLength = strlen($characters);
    $numberLength = strlen($number);
    $randomString = '';
    for ($i = 0; $i < 3; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    for ($i = 0; $i < 3; $i++) {
        $randomString .= $number[rand(0, $numberLength - 1)];
    }
    $randomString = str_shuffle($randomString);
    return $randomString;
}
if (!function_exists('propertytype')) {
    function propertytype(){
        $string = array(
                        1 => 'All suite',
                        2 => 'Resort',
                        3 => 'Business',
                        4 => 'Extended Stay',
                        5 => 'Meeting',
                        6 => 'Residential Apartment',
                        7 => 'Others'
                    );

        return $string;
    }
}

if (!function_exists('deposittype')) {
    function deposittype(){
        $string = array(
                        'tt' => 'TT',
                        'bank draft' => 'Bank Draft',
                        'credit' => 'Credit',
                        'other' => 'Others'
                    );
        return $string;
    }
}

if (!function_exists('paymenttype')) {
    function paymenttype(){
        $string = array(
                        'tt' => 'TT',
                        'bank draft' => 'Bank Draft',
                        'credit' => 'Credit',
                        'other' => 'Others'
                    );
        return $string;
    }
}

if (!function_exists('season')) {
    function season(){
        $string = array(
                        'low season' => 'Low season',
                        'shoulder season' => 'shoulder season',
                        'high season' => 'high season'
                    );
        return $string;
    }
}

if (!function_exists('text_to_array')) {
    function text_to_array($path)
    {
        $obj = [];
        $file_handle = fopen($path, "rb");
        while (!feof($file_handle)) {
            $line_of_text = fgets($file_handle);
            if(!ctype_space($line_of_text)){
                array_push($obj, $line_of_text);
            }

        }

        fclose($file_handle);
        return $obj;
    }
}