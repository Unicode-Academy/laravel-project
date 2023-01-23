@extends('layouts.client')
@section('title', 'Chi tiết người dùng')
@section('content')
<h1>{{trans('user::custom.title', ['name' => 'Demo'])}}: {{$id}}</h1>

@endsection