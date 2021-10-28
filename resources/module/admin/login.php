@extends('layout/admin/auth')
@section('content')
    <form action="{{ Config::get('url/base_url') }}/login?admin" method="post">
        <label for="username">Username : </label>
        <input type="text" name="username" /><br/>
        <label for="password">Password : </label>
        <input type="Password" name="password" /><br/>
        <input type="hidden" name="token" value="{{ Token::generate('user') }}" />
        <input type="submit" name="register" value="Register" />
    </form>
@endsection