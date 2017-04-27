@extends('layouts.layout')

@section('header')
    @parent
@endsection

@section('body')

    <form action="{{ route('update', $place_id) }}" method="post">
        {{ csrf_field() }}
        <input type="text" name="place_name" value="{{ $place->position_name }}">
        <input type="text" name="place_lat"  value="{{ $place->position_lat }}">
        <input type="text" name="place_lng"  value="{{ $place->position_lng }}">
        <input type="text" name="place_descr" value="{{ $place->description }}">
        <input type="submit" name="update" value="Update">

    </form>

@endsection

@section('footer')

    @parent
@endsection
