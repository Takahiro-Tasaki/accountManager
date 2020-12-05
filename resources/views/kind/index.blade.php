@extends('layouts.app')

@section('title', '種類')

@php
$breadcrumb = [
	['name' => '種類', 'href' => 'kind'],
	['name' => 'サンプル', 'href' => 'sample'],
	['name' => 'テスト', 'href' => '']
];

$leftNav = [
	['name' => '種類', 'href' => 'kind'],
	['name' => 'サンプル', 'href' => 'sample'],
	['name' => 'テスト', 'href' => '']
]
@endphp