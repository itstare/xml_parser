@extends('layouts.app')
@section('content')
	<form action="{{ route('update', request()->route('id')) }}" method="POST">
	    <div class="row">
			@foreach($imageData as $img)
			<div class="col-md-2 my-2">
				<img src="{{ $img->url }}" class="img-thumbnail"/>
				<input type="text" name="category[]" value="{{ $img->category }}" class="form-control" required>
				<input type="hidden" name="id[]" value="{{ $img->image_id }}">
			</div>
			@endforeach
		</div>
		<button type="submit" class="btn btn-primary btn-lg mt-2">Update</button>
		@csrf
	</form>
@endsection