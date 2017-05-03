@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form action="{{ route('update', $place_id) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="place_name">Name: </label>
                    <input type="text" class="form-control" name="place_name" value="{{ $place->position_name }}">
                </div>
                <div class="form-group">
                    <label for="place_lat">Lat: </label>
                    <input type="text" class="form-control" name="place_lat"  value="{{ $place->position_lat }}">
                </div>
                <div class="form-group">
                    <label for="place_lng">Lng: </label>
                    <input type="text" class="form-control" name="place_lng"  value="{{ $place->position_lng }}">
                </div>
                <div class="form-group">
                    <label for="place_descr">Description: </label>
                    <input type="text" class="form-control" name="place_descr" value="Description">
                </div>
                <input type="submit" class="btn btn-primary" name="update" value="Change">

            </form>
        </div>
    </div>

@endsection

@section('footer')

    @parent
@endsection
