@extends('layouts.app01')

@foreach($breadcrumb as $item)
  @if($item['href'] === '')
    @section('title', $item['name'])
  @endif
@endforeach

@section('content')
  <form method="POST" action="/kind/{{$data->kind_id}}">
    @method('PUT')
    @csrf
    <table class="table">
      <tr>
        <th scope="col">Name</th>
        <td>
          <input name="name" type="text" maxlength="20" tabindex="1" autofocus placeholder="最大20文字" value="{{$data->name}}" class="form-control @error('name') is-invalid @enderror">
          @error('name')
          <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </td>
      </tr>
      <tr>
        <th scope="col">Kana</th>
        <td>
          <input name="kana" type="text" maxlength="50" tabindex="2" placeholder="最大25文字" value="{{$data->kana}}" class="form-control @error('kana') is-invalid @enderror">
          @error('kana')
          <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </td>
      </tr>
    </table>
    <input type="submit" value="編集" tabindex="3" class="btn btn-secondary btn-sm">
    <a href="{{route('kind.index')}}" class="btn btn-info btn-sm">戻る</a>
  </form>
@endsection