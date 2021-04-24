@extends('layouts.app01')

@foreach($breadcrumb as $item)
  @if($item['href'] === '')
    @section('title', $item['name'])
  @endif
@endforeach

@section('content')
  <form method="POST" action="/kind">
    @csrf
    <table class="table">
      <tr>
        <th scope="col">Name</th>
        <td class="has-validation">
          <input name="name" type="text" maxlength="20" tabindex="1" autofocus placeholder="最大20文字" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
          @error('name')
          <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </td>
      </tr>
      <tr>
        <th scope="col">Kana</th>
        <td>
          <input name="kana" type="text" maxlength="50" tabindex="2" placeholder="最大25文字" class="form-control @error('kana') is-invalid @enderror" value="{{old('kana')}}">
          @error('kana')
          <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </td>
      </tr>
    </table>
    <input type="submit" value="登録" tabindex="3" class="btn btn-secondary btn-sm">
    <a href="{{route('kind.index')}}" class="btn btn-info btn-sm">戻る</a>
  </form>
@endsection