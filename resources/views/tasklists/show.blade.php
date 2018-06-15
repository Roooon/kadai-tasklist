@extends('layouts.app')

@section('content')

<h1>id = {{ $tasklist->id }} のタスクリスト詳細ページ</h1>
 <div class="row">
  <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
   <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $tasklist->id }}</td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>{{ $tasklist->status}}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{ $tasklist->content }}</td>
        </tr>
    </table>
  </div>
 </div>
    

    {!! link_to_route('tasklists.edit', 'このタスクリストを編集', ['id' => $tasklist->id], ['class' => 'btn btn-default']) !!}

    {!! Form::model($tasklist, ['route' => ['tasklists.destroy', $tasklist->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    
@endsection