@extends('layouts.app')

@section('content')

    <h1>タスクリスト一覧</h1>

    @if (count($tasklists) > 0)
<table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Status</th>
                    <th>タスクリスト</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasklists as $tasklist)
                    <tr>
                        <td>{!! link_to_route('tasklists.show', $tasklists->id, ['id' => $tasklists->id]) !!}</td>
                        <td>{{ $tasklist->title }}</td>
                        <td>{{ $tasklist->content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {!! link_to_route('tasklists.create', '新規タスクリストの投稿', null, ['class' => 'btn btn-primary']) !!}

@endsection