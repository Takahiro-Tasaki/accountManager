@extends('layouts.app01')

@foreach($breadcrumb as $item)
  @if($item['href'] === '')
    @section('title', $item['name'])
  @endif
@endforeach

@section('content')
  <a class="btn btn-primary" href="kind/create" role="button">新規登録</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Kana</th>
        <th scope="col">Create Date</th>
        <th scope="col">Update Date</th>
        <th scope="col">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{$item->kind_id}}</td>
          <td><a href="{{route('kind.edit', $item->kind_id)}}">{{$item->name}}</a></td>
          <td>{{$item->kana}}</td>
          <td>{{$item->create_date}}</td>
          <td>{{$item->update_date}}</td>
          <td><a href="{{route('kind.show', $item->kind_id)}}">削除</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection