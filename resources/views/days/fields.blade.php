<!-- When Field -->
<div class="form-group col-sm-6">
    {!! Form::label('when', 'When:') !!}
    {!! Form::date('when', null, ['class' => 'form-control']) !!}
</div>

<!-- Event Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('event_id', 'Event Id:') !!}
    {!! Form::number('event_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.days.index') !!}" class="btn btn-default">Cancel</a>
</div>
