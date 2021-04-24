@extends('layouts.app01')

@foreach($breadcrumb as $item)
  @if($item['href'] === '')
    @section('title', $item['name'])
  @endif
@endforeach

@section('content')
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Create Date</th>
        <th scope="col">Update Date</th>
        <th scope="col">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{$item->id}}</td>
          <td>
            @if( is_null($item->image) )
            <img src="{{config('consts.common.ROOT_PATH')}}storage/users/no-image.png" width="60" height="auto">
            @else
            <img src="{{config('consts.common.ROOT_PATH')}}storage/users/{{$item->image}}" width="60" height="auto">
            @endif
          </td>
          <td>
            @if ($item->user_id)
            <a href="{{route('user.edit', $item->id)}}">{{$item->name}}</a>
            @else
            <a href="{{route('user.create', ['id' => $item->id])}}">{{$item->name}}</a>
            @endif
          </td>
          <td>{{$item->email}}</td>
          <td>{{$item->created_at}}</td>
          <td>{{$item->updated_at}}</td>
          <td><a href="{{route('user.show', $item->id)}}">削除</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $items->links('pagination::bootstrap-4') }}
@endsection