@extends('layouts.app01')

@foreach($breadcrumb as $item)
  @if($item['href'] === '')
    @section('title', $item['name'])
  @endif
@endforeach

@section('content')
  <p>本当に削除しますか？</p>
  <form method="POST" action="/kind/{{$data->kind_id}}">
    @method('DELETE')
    @csrf
    <table class="table">
      <tr>
        <th scope="col">Name</th>
        <td>{{$data->name}}</td>
      </tr>
      <tr>
        <th scope="col">Kana</th>
        <td>{{$data->kana}}</td>
      </tr>
    </table>
    <input type="submit" value="削除" tabindex="3" class="btn btn-secondary btn-sm">
    <a href="{{route('kind.index')}}" class="btn btn-info btn-sm">戻る</a>
  </form>
@endsection