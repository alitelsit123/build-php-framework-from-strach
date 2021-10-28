<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Config::get('template/user/title') }}</title>
    <!-- <base href="{{ Config::get('url/base_url') }}" /> -->
    <link rel="stylesheet" href="{{ Config::get('template/user/css/style') }}">
</head>
<body>
    @yield('content')
</body>
</html>