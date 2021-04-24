@extends('layouts.app01')

@foreach($breadcrumb as $item)
  @if($item['href'] === '')
    @section('title', $item['name'])
  @endif
@endforeach

@section('content')
  <form method="POST" action="/user/{{$data->id}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <table class="table">
      <tr>
        <th scope="col">Name</th>
        <td>
          {{$data->name}}
        </td>
      </tr>
      <tr>
        <th scope="col">Email</th>
        <td>
          {{$data->email}}
        </td>
      </tr>
      <tr>
        <th scope="col">Image</th>
        <td>
          @if( is_null($data->image) )
          <img src="{{config('consts.common.ROOT_PATH')}}storage/users/no-image.png" width="100" height="auto">
          @else
          <img src="{{config('consts.common.ROOT_PATH')}}storage/users/{{$data->image}}" width="100" height="auto">
          @endif
          <input name="image" type="file" tabindex="1" autofocus value="{{$data->image}}" class="form-control @error('image') is-invalid @enderror">
          @error('image')
          <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </td>
      </tr>
      <tr>
        <th scope="col">Auth</th>
        <td>
          <!-- <input name="auth" type="number" min="1" max="99" tabindex="2" value="{{$data->auth}}" class="form-control "> -->
          <select name="auth" class="form-select form-select-ms">
            @switch($data->auth)
              @case(99)
                <option value="1">一般</option>
                <option value="99" selected>管理者</option>
                @break
              @case(1)
              @default
                <option value="1" selected>一般</option>
                <option value="99">管理者</option>
            @endswitch
          </select>
        </td>
      </tr>
    </table>
    <input type="submit" value="編集" tabindex="3" class="btn btn-secondary btn-sm">
    <a href="{{route('user.index')}}" class="btn btn-info btn-sm">戻る</a>
  </form>
@endsection