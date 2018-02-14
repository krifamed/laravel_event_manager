<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $event->id !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $event->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $event->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $event->updated_at !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $event->title !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $event->description !!}</p>
</div>

<!-- Places Field -->
<div class="form-group">
    {!! Form::label('places', 'Places:') !!}
    <p>{!! $event->places !!}</p>
</div>

<!-- Public Field -->
<div class="form-group">
    {!! Form::label('public', 'Public:') !!}
    <p>{!! $event->public !!}</p>
</div>

<!-- Owner Field -->
<div class="form-group">
    {!! Form::label('owner', 'Owner:') !!}
    <p>{!! $event->owner !!}</p>
</div>

<!-- Start Field -->
<div class="form-group">
    {!! Form::label('start', 'Start:') !!}
    <p>{!! $event->start !!}</p>
</div>

<!-- End Field -->
<div class="form-group">
    {!! Form::label('end', 'End:') !!}
    <p>{!! $event->end !!}</p>
</div>

