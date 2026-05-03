@if (request('post_type') === 'job-offer')
  @include('archive-job-offer')
@else
  @include('partials.search-default')
@endif
