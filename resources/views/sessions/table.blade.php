<table class="table table-responsive" id="sessions-table">
    <thead>
        <tr>
            <th>Title</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Payed</th>
        <th>Description</th>
        <th>Speaker</th>
        <th>Day Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sessions as $session)
        <tr>
            <td>{!! $session->title !!}</td>
            <td>{!! $session->start_date !!}</td>
            <td>{!! $session->end_date !!}</td>
            <td>{!! $session->payed !!}</td>
            <td>{!! $session->description !!}</td>
            <td>{!! $session->speaker !!}</td>
            <td>{!! $session->day_id !!}</td>
            <td>
                {!! Form::open(['route' => ['destroySession', $eventId, $dayId, $session->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('showSession', [$eventId, $dayId, $session->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('editSession', [$eventId, $dayId, $session->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
