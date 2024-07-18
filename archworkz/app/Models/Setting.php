<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public const ID = 'id';
    public const EN = 'en';
    public const NAME = 'name';
    public const ABOUT = 'about';
    public const EMAIL = 'email';
    public const PHONE = 'phone';
    public const YOUTUBE = 'youtube';
    public const WHATSAPP = 'whatsapp';
    public const ADDRESS = 'address';
    public const GMAPS = 'gmaps';
    public const PIXEL = 'pixel';
    public const ANALYTICS = 'analytics';
    public const DESCRIPTION = 'description';
    public const META_DESCRIPTION = 'meta_description';
    public const LOGO = 'logo';
    public const LOGO_GRAY = 'logo_gray';
    public const ICON = 'icon';
    public const OGIMAGE = 'ogimage';
    public const FILE = 'file';
    public const PROFILE = 'profile';
    public const SERVICE = 'service';
    public const DOCTOR = 'doctor';
    public const PARTNER = 'partner';
    public const BLOG = 'blog';
    public const PAGE = 'page';
    public const CONTACT = 'contact';

    protected $fillable = [
        'key',
        'locale',
        'value',
        'additional_value',
        'json_value',
        'additional_json_value',
    ];

    public function scopeKey($query, $key)
    {
        return $query->where('key', $key);
    }

    public function scopeLocale($query, $lang)
    {
        return $query->whereLocale($lang);
    }

    public function getJsonValueAttribute($value)
    {
        return json_decode($value);
    }

    public function getAdditionalJsonValueAttribute($value)
    {
        return json_decode($value);
    }
}
