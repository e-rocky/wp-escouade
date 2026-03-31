{{--
Template Name: Bordered
--}}

@extends('layouts.app')

@section('content')
@while(have_posts()) @php(the_post())
@include('partials.content-single-bordered')
@endwhile
@endsection
