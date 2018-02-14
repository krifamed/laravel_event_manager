<table class="table table-responsive" id="days-table">
    <thead>
        <tr>
            <th>When</th>
        <th>Event Id</th>
        <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($days as $day)
        <tr>
            <td>{!! $day->when !!}</td>
            <td>{!! $day->event_id !!}</td>
            <td>{!! $day->name !!}</td>
            <td>
                {!! Form::open(['route' => ['days.destroy', $day->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sessions', [ $eventId, $day->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('days.edit', [$day->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
