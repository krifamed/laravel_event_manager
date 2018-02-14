<table class="table table-responsive" id="events-table">
    <thead>
        <tr>
            <th>Title</th>
        <th>Description</th>
        <th>Places</th>
        <th>Public</th>
        <th>Owner</th>
        <th>Start</th>
        <th>End</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr>
            <td>{!! $event->title !!}</td>
            <td>{!! $event->description !!}</td>
            <td>{!! $event->places !!}</td>
            <td>{!! $event->public !!}</td>
            <td>{!! $event->owner !!}</td>
            <td>{!! $event->start !!}</td>
            <td>{!! $event->end !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.events.destroy', $event->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('participants', [$event->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('days', [$event->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-close"></i></a>
                    <a href="{!! route('admin.events.edit', [$event->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
