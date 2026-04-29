@extends('layouts.app')
@section('content')
  @php
    $errorPage = get_page_by_path('erreur-404', OBJECT, 'page');
  @endphp

  @if ($errorPage instanceof WP_Post && $errorPage->post_status === 'publish')
    {!! apply_filters('the_content', $errorPage->post_content) !!}
  @else
    @include('partials.page-header')

    <x-alert type="warning">
      {!! __('Sorry, but the page you are trying to view does not exist.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif
@endsection
