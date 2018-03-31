@include('layouts.header_includes')

<div class="full-page-container px-8">
    <div class=" text-center" style="margin-top:15vh;" >
        <div class="media-box d-inline-block media-box-lg bg-primary text-white mb-8" style="">
            <i class="material-icons">all_inclusive</i>
        </div>

    </div>
    <div class="text-center">
        <h1 class="mb-4">
            Page Not Found
        </h1>
        <h4 class="mb-4">
            Oops..
        </h4>
        <p class="mb-1">
            Looks like you have navigated too far from Federation Space. Our Application cannot help you here.
        </p>
        <p class="mb-10">
            Sorry Scotty, you are on your own.
        </p>
        <p>
            <a class="btn btn-outline-primary" href="{{route('payments')}}">Return to the Space Station</a>
        </p>
    </div>
</div>

@include('layouts.footer_includes')