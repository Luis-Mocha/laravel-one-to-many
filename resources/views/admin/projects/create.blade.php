@extends('layouts.app')
@section('content')

<div class="jumbotron p-3 mb-4 bg-light rounded-3">
    <div class="container py-5">

        <h1 class="display-5 fw-bold">
            Creazione di un nuovo progetto
        </h1>
    </div>
</div>

<div class="content">
    <div class="container mb-4">

        <form action=" {{ route('admin.projects.store') }} " method="POST" enctype="multipart/form-data" class="row text-light" autocomplete="off" >

            @csrf

            <div class="form-group mt-3">
                <label for="input-title" class="form-label">Title:</label>
                <input type="text" id="input-title" class="form-control" name="title" placeholder="Inserisci il titolo" required value="{{ old('title') }}"> 
            </div>
            {{-- errore validazione --}}
            @error('title')
                <div class="alert alert-warning py-1 m-0 fst-italic">{{ $message }}</div>
            @enderror

            <div class="form-group mt-3 ">
                <label for="input-description" class="form-label">Description:</label>
                <textarea id="input-description" class="form-control" name="description" cols="30" rows="5">{{ old('description') }}</textarea>
            </div>

            <div class="form-group mt-3">
                <label for="input-link_project" class="form-label">Link Progetto:</label>
                <input type="text" id="input-link_project" class="form-control" name="link_project" placeholder="Inserisci il link al progetto" value="{{ old('link_project') }}"> 
            </div>
            {{-- errore validazione --}}
            @error('link_project')
                <div class="alert alert-warning py-1 m-0 fst-italic">{{ $message }}</div>
            @enderror

            <div class="form-group mt-3">
                <label for="input-cover_img" class="form-label">File immagine:</label>
                <input type="file" name="cover_img" id="input-cover_img" class="form-control">
            </div>
            {{-- errore validazione --}}
            @error('cover_img')
                <div class="alert alert-warning py-1 m-0 fst-italic">{{ $message }}</div>
            @enderror 

            {{-- Input type usando un ciclo--}}
            <div class="form-group mt-3">
                <label for="input-type_id" class="form-label">Project type:</label>
                <select name="type_id" id="input-type_id" class="form-control">

                    <option value="">-- Scegli una tipologia --</option>
                    @foreach ($types as $elem)

                        <option value="{{$elem->id}}">
                            {{$elem->name}}
                        </option>

                    @endforeach

                </select>
            </div>
            {{-- errore validazione --}}
            @error('type_id')
                <div class="alert alert-warning py-1 m-0 fst-italic">{{ $message }}</div>
            @enderror 

            
            <div>
                <button type="submit" class="btn btn-primary my-4 col-2 d-block mx-auto">
                    create Project
                </button>
            </div>

            

        </form>

    </div>
</div>
@endsection