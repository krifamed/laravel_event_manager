<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Date Field -->
<div class="form-group col-sm-6">
  {!! Form::label('start_date', 'Start Date:') !!}
  <div class='input-group date' id='calendar'>
    {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
    </span>
  </div>
</div>
<!-- End Date Field -->
<div class="form-group col-sm-6">
  {!! Form::label('end_date', 'End Date:') !!}
  <div class='input-group date' id="datetimepicker2">
    {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
    </span>
  </div>
</div>

<!-- Payed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payed', 'Payed:') !!}
    {!! Form::text('payed', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}

    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Speaker Field -->
<div class="form-group col-sm-6">
    {!! Form::label('speaker', 'Speaker:') !!}
    {!! Form::text('speaker', null, ['class' => 'form-control']) !!}
</div>

<!-- Day Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('day_id', 'Day Id:') !!}
    {!! Form::number('day_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sessions.index') !!}" class="btn btn-default">Cancel</a>
</div>
