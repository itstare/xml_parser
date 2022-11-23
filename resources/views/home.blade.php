@extends('layouts.app')
@section('content')
<div class="container">
	<form action="{{ route('insert') }}" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="file">Upload XML File</label>
			<input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
			
			@error('file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
		</div>
		<button class="btn btn-primary mt-3">Submit</button>
		@csrf
	</form>
</div>
@endsection