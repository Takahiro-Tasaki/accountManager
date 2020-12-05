<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>@yield('title') - Account Manager</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container-lg">
		<header class="row">
			<div class="col">
				<a href="{{ url('') }}" class="header-logo">
					<img src="images/logo.png" alt="Account Manager">
				</a>
			</div>
		</header>
    <div class="row">
      <nav class="col">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="/">Account Manager</a>
					</li>
					@foreach($breadcrumb as $item)
					@if($item['href'] !== '')
					<li class="breadcrumb-item">
						<a href="{{$item['href']}}">{{$item['name']}}</a>
					</li>
					@else
					<li class="breadcrumb-item active" aria-current="page">
						{{$item['name']}}
					</li>
					@endif
					@endforeach
				</ol>
      </nav>
    </div>
    <div class="row">
      <nav class="col">
				<ul class="nav flex-column nav-pills">
					@foreach($leftNav as $item)
					@if($item['href'] !== '')
					<li class="nav-item">
						<a class="nav-link" href="{{$item['href']}}">{{$item['name']}}</a>
					</li>
					@else
					<li class="nav-item">
						<a class="nav-link active" href="">{{$item['name']}}</a>
					</li>
					@endif
					@endforeach
				</ul>
      </nav>
      <main class="col">
        コンテンツ
      </main>
    </div>
    <footer class="row">
      <div class="col">
        フッター
      </div>
    </footer>
  </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>