@extends('layouts.app')

@section('content')
<div class="container-fluid bg-black vh-100">
    <div class="row justify-content-center align-items-center h-100 ">
        <div class="col-md-8">
            <div class="card text-black bg-black">
                <div class="card-header bg-black">{{ __('Dashboard') }}</div>
                <div class="card-body bg-black text-center">  
                    <a href="/shop" type="submit" class="btn btn-warning btn-block custom-button shadow">{{ __('GO Shopping') }} <i class="fas fa-arrow-right"></i></a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-black"></div>
   
            </div>
        </div>
    </div>

</div>

<script>
$(document).ready(function() {
    $(".custom-button").slideUp(0);

    $(".custom-button").slideDown("slow", function() {
        $(this).animate({top: "50%"}, "slow");
    });
});
</script>

@endsection
