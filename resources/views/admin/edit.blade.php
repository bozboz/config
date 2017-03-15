@extends('admin::edit')

@section('main')
@parent
    <h3 style="clear:both;">Revision History</h3>
    <table class="table">
        <tr>
            <th>Old</th>
            <th>New</th>
            <th>User</th>
            <th>When</th>
        </tr>
    @foreach ($model->history as $revision)
        <tr>
            <td><del>{!!nl2br(e($revision->old))!!}</del></td>
            <td>{!!nl2br(e($revision->new))!!}</td>
            <td>{{$revision->user_name}}</td>
            <td>
                <abbr title="{{$revision->created_at->format('d M Y H:i')}}">
                    {{$revision->created_at->diffForHumans()}}
                </abbr>
            </td>
        </tr>
    @endforeach
    </table>
@stop
