@extends('layouts.layout')

@section('header')
    @parent
@endsection

@section('body')

    <h1>Admin panel</h1>
    <hr>
    <span>Нових місць: {{ $new }}</span>
    <table border="1">
        <tr>
            <td>Name</td>
            <td>Lat</td>
            <td>Lng</td>
            <td>Description</td>
            <td>Status</td>
            <td>Likes</td>
            <td>Action</td>
        </tr>
    @foreach($positions as $pos)

        <tr>
            <td style="padding: 5px;">{{ $pos->position_name }}</td>
            <td style="padding: 5px;">{{ $pos->position_lat }}</td>
            <td style="padding: 5px;">{{ $pos->position_lng }}</td>
            <td style="padding: 5px;">{{ $pos->description }}</td>
            <td style="padding: 5px;">{{ $pos->status }}</td>
            <td style="padding: 5px;">{{ App\Position::find($pos->id)->like->likes }}</td>
            <td style="padding: 5px;"><a href="{{ route('delete', $pos->id) }}">Delete</a><a href="{{ route('update', $pos->id) }}">/Change</a>@if($pos->status == 0)<a href="{{ route('confirm', $pos->id) }}">/ Confirm</a>@endif</td>
        </tr>

    @endforeach
    </table>

@endsection

@section('footer')

    @parent
@endsection
