<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="{{asset(@$setting->firstWhere('key', 'icon')->value)}}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>@yield('title', @$about->title )</title>

@section('meta')
<meta name="keywords" content="{{@$about->meta_keywords}}" />
<meta name="description" content="{{@$about->meta_description}}" />
<meta name="author" content="{{@$setting->firstWhere('key','name')->value}}" />
<meta property="og:image" content="{{@$setting->firstWhere('key','ogimage')->value}}">
@show