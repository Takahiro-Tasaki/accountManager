@extends('layouts.app01')

@foreach($breadcrumb as $item)
  @if($item['href'] === '')
    @section('title', $item['name'])
  @endif
@endforeach

@section('content')
  <p>本当に削除しますか？</p>
  <form method="POST" action="/user/{{$data->id}}">
    @method('DELETE')
    @csrf
    <table class="table">
      <tr>
        <th scope="col">Name</th>
        <td>{{$data->name}}</td>
      </tr>
      <tr>
        <th scope="col">Image</th>
        <td>
          @if( is_null($data->image) )
          <img src="{{config('consts.common.ROOT_PATH')}}storage/users/no-image.png" width="100" height="auto">
          @else
          <img src="{{config('consts.common.ROOT_PATH')}}storage/users/{{$data->image}}" width="100" height="auto">
          @endif
        </td>
      </tr>
      <tr>
        <th scope="col">Auth</th>
        <td>
          @switch($data->auth)
            @case(99)
              管理者
              @break
            @case(1)
            @default
              一般
          @endswitch
        </td>
      </tr>
    </table>
    <input type="submit" value="削除" tabindex="3" class="btn btn-secondary btn-sm">
    <a href="{{route('user.index')}}" class="btn btn-info btn-sm">戻る</a>
  </form>
@endsection