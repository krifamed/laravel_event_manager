<table class="table table-responsive" id="participations-table">
    <thead>
        <tr>
            <th>Client Name</th>
            <th>Participated</th>
            <th colspan="3">Accept</th>
        </tr>
    </thead>
    <tbody>
    @foreach($participations as $participation)
        <tr>
            <td>{!! $participation->fname !!}</td>
            <td>{!! $participation->participated !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('accept', [$participation->id, $eventId]) !!}" class='btn btn-default btn-xs'><i>yes</i></a>
                    <a href="{!! route('admin.events.edit', [$participation->id]) !!}" class='btn btn-danger btn-xs'><i>no</i></a>
                    <!-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} -->
                </div>
                <!-- {!! Form::close() !!} -->
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
