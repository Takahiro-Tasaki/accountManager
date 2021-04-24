@extends('layouts.app01')

@foreach($breadcrumb as $item)
  @if($item['href'] === '')
    @section('title', $item['name'])
  @endif
@endforeach

@section('content')
  <a class="btn btn-primary" href="category/create" role="button">新規登録</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Parent</th>
        <th scope="col">Create Date</th>
        <th scope="col">Update Date</th>
        <th scope="col">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{$item->category_id}}</td>
          <td><a href="{{route('category.edit', $item->category_id)}}">{{$item->name}}</a></td>
          <td>
            @if ($item->parent_id === 0)
            なし
            @else
            {{$items[$item->parent_id - 1]->name}}
            @endif
          </td>
          <td>{{$item->create_date}}</td>
          <td>{{$item->update_date}}</td>
          <td><a href="{{route('category.show', $item->category_id)}}">削除</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection