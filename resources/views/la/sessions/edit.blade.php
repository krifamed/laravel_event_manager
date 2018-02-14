@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/sessions') }}">Session</a> :
@endsection
@section("contentheader_description", $session->$view_col)
@section("section", "Sessions")
@section("section_url", url(config('laraadmin.adminRoute') . '/sessions'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Sessions Edit : ".$session->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($session, ['route' => [config('laraadmin.adminRoute') . '.sessions.update', $session->id ], 'method'=>'PUT', 'id' => 'session-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title')
					@la_input($module, 'start_date')
					@la_input($module, 'end_date')
					@la_input($module, 'payed')
					@la_input($module, 'description')
					@la_input($module, 'speaker')
					@la_input($module, 'day_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/sessions') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#session-edit-form").validate({
		
	});
});
</script>
@endpush
