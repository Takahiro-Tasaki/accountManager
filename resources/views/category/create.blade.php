@extends('layouts.app01')

@foreach($breadcrumb as $item)
  @if($item['href'] === '')
    @section('title', $item['name'])
  @endif
@endforeach

@section('content')
  <form method="POST" action="/category">
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
        <th scope="col">ParentId</th>
        <td>
          <select name="parent_id" aria-label="Default select example" class="form-select form-control @error('parent_id') is-invalid @enderror" required>
            <option value="0">なし</option>
            @foreach ($items as $item)
            <option value="{{$item->category_id}}">{{$item->name}}</option>
            @endforeach
          </select>
          @error('parent_id')
          <span class="invalid-feedback">{{$message}}</span>
          @enderror
        </td>
      </tr>
    </table>
    <input type="submit" value="登録" tabindex="3" class="btn btn-secondary btn-sm">
    <a href="{{route('category.index')}}" class="btn btn-info btn-sm">戻る</a>
  </form>
@endsection