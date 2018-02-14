@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Organiser
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($organiser, ['route' => ['organisers.update', $organiser->id], 'method' => 'patch']) !!}

                        @include('organisers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection