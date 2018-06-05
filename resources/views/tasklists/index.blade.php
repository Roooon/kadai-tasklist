@extends('layouts.app')

@section('content')

    <h1>メッセージ一覧</h1>

    @if (count($tasklits) > 0)
        <ul>
            @foreach ($tasklists as $tasklist)
                <li>{!! link_to_route('tasklist.show', $tasklist->id, ['id' => $tasklist->id]) !!} : {{ $tasklist->content }}</li>
            @endforeach
        </ul>
    @endif
    
     {!! link_to_route('tasklist.create', '新規タスクリストの投稿') !!}

@endsection