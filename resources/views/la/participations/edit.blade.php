@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/participations') }}">Participation</a> :
@endsection
@section("contentheader_description", $participation->$view_col)
@section("section", "Participations")
@section("section_url", url(config('laraadmin.adminRoute') . '/participations'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Participations Edit : ".$participation->$view_col)

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
				{!! Form::model($participation, ['route' => [config('laraadmin.adminRoute') . '.participations.update', $participation->id ], 'method'=>'PUT', 'id' => 'participation-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'client_id')
					@la_input($module, 'event_id')
					@la_input($module, 'participated')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/participations') }}">Cancel</a></button>
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
	$("#participation-edit-form").validate({
		
	});
});
</script>
@endpush
