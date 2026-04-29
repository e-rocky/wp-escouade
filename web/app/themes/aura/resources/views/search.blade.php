@if (request('post_type') === 'job-offer')
  @include('partials.search-job-offer')
@else
  @include('partials.search-default')
@endif
