@extends('layouts.app')
@section('content')
	{{ $stringData->string1 }}
	{{ $stringData->string2 }}
	{{ $stringData->string3 }}
	{{ '<MultiMedia><Images>' }}
	@foreach($imageData as $data)
	{{ $data->string() }}
	@endforeach
	{{ '</Images></MultiMedia>' }}
	{{ $closeTag }}
@endsection