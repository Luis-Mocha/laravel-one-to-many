@extends('layouts.app')
@section('content')

<div class="jumbotron p-3 mb-4 bg-light rounded-3">
    <div class="container py-5">

        <h1 class="display-5 fw-bold">
            Project List
        </h1>

        <a href="{{ route('admin.projects.create') }}">
            <button class="btn btn-primary mt-3">
                Create Project
            </button>
        </a>
    </div>
</div>

<div class="content">
    <div class="container mb-4">

        {{-- messaggio in caso di successo creazione fumetto --}}
        @if (Session::has('successCreate') )
            <div class="alert bg-primary text-center text-light">
                {!! Session::get('successCreate') !!}
            </div>
        @endif

        {{-- messaggio in caso di successo modifica fumetto --}}
        @if (Session::has('successEdit') )
            <div class="alert bg-primary text-center text-light">
                {!! Session::get('successEdit') !!}
            </div>
        @endif

        <div class="card-container">
            @forelse ($projects as $elem)

                <div class="project-card p-3 mt-2 border rounded d-flex justify-content-between align-items-center">

                    <div class="fs-3">{{$elem['title']}}</div>

                    <div>
                        {{-- bottone edit --}}
                        <button class="btn btn-warning" data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Edit this Project">
                            <a href="{{route ('admin.projects.edit', $elem) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </button>

                        {{-- bottone delete --}}
                        <form action=" {{ route('admin.projects.destroy', $elem) }} " method="POST" class="d-inline-block">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Delete this Project" onclick=" return stopDelete(' {{ $elem['title'] }} ')">
                                <a href="">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </button>
                        </form>
                    </div>
                </div>
            
            @empty
                <h2 class="text-center">Al momento non ci sono progetti</h2>
            @endforelse
        </div>

    </div>
</div>
@endsection

{{-- SCRIPT CUSTOM --}}
@section('script-custom')

<script>
    // console.log(' helloo ');

    function stopDelete(par) {
        return confirm(`The deletion will be permanent. Do you confirm you want to delete ${par}?`)
    };
</script>

@endsection