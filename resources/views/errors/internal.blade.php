@extends('layouts.app')
@section('content')
<div class="container mt-10">

    <div class="row align-items-md-center content-space-2 content-space-b-lg-2">
        <div class="col-md-6 order-md-2 mb-10 mb-md-0 text-center offset-3" >
            <h2 class="h1 lh-sm">Internal Server Error!</h2>
            <p>Looks like something went wrong. Please try again or contact our technical support staff if the problem persists.</p>
            @if(env("APP_DEBUG"))
                 <code>{{$error}}</code>
            @endif
            <div class="mt-10">
                <a class="btn btn-primary btn-transition" href="/">Back Home<i class="bi-chevron-right small "></i></a>
            </div>


        </div>
    </div>
</div>


@endsection
