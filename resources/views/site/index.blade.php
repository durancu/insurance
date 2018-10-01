@extends('site.layouts.app')

@section('content')
    
    <div class="tab-content">
        
        @include('site.partials.index.tab-1')
        
        @include('site.partials.index.tab-2')
        
        @include('site.partials.index.tab-3')
    
    </div><!-- /tab content -->
    
@endsection