<x-layout title="Home">

    <div class="row">
        <div class="col-sm-12">

            @auth
            {{ Auth::user()->displayName }}
            @else
                Not Logged In.
            @endauth
        </div>
    </div>

</x-layout>
