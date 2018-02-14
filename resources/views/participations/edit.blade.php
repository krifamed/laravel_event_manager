@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Participation
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($participation, ['route' => ['participations.update', $participation->id], 'method' => 'patch']) !!}

                        @include('participations.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection