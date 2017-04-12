@extends('admin::edit')

@section('main')
@parent
    @if ( ! $model->history->isEmpty())
        <h3 style="clear:both;">Revision History</h3>
        <table class="table">
            <tr>
                <th>Value</th>
                <th>User</th>
                <th>When</th>
            </tr>
        @foreach ($model->history as $revision)
            <tr>
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
    @endif
@stop
