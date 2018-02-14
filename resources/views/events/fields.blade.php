<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Places Field -->
<div class="form-group col-sm-6">
    {!! Form::label('places', 'Places:') !!}
    {!! Form::number('places', null, ['class' => 'form-control']) !!}
</div>

<!-- Public Field -->
<div class="form-group col-sm-6">
    {!! Form::label('public', 'Public:') !!}
    {!! Form::text('public', null, ['class' => 'form-control']) !!}
</div>

<!-- Owner Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner', 'Owner:') !!}
    {!! Form::number('owner', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start', 'Start:') !!}
    {!! Form::date('start', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('end', 'End Date:') !!}
  <div class='input-group date' id="eventEnd">
    {!! Form::text('end', null, ['class' => 'form-control']) !!}
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
    </span>
  </div>
</div>
<!-- End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end', 'End:') !!}
    {!! Form::date('end', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.events.index') !!}" class="btn btn-default">Cancel</a>
</div>
