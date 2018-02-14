@extends('la.layouts.app')
<!-- @section('headerElems') >
<div class="row" style="padding-left: 20px">
    <a href="{!! route('admin.events.index') !!}" class="btn btn-primary">Show Participant</a>
</div>
< @endsection -->

@section('main-content')
    <section class="content-header">
        <div class="row" style="padding-left: 20px">
            <a href="{!! route('participants') !!}" class="btn btn-primary">Show Participant</a>
        </div>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('events.show_fields')
                    <a href="{!! route('admin.events.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
