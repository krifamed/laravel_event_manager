<table class="table table-responsive" id="organisers-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Description</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($organisers as $organiser)
        <tr>
            <td>{!! $organiser->name !!}</td>
            <td>{!! $organiser->description !!}</td>
            <td>{!! $organiser->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['organisers.destroy', $organiser->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('organisers.show', [$organiser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('organisers.edit', [$organiser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>