@extends('layouts.app')
@section('content')

<div class="page-hero">
    <div class="jumbotron p-5 mb-4 rounded-3">
        <div class="container py-5">
    
            <h1 class="display-5 fw-bold type" style="--n:15; width: fit-content">
                Hello, I'm Luis
            </h1>
    
            <a href="{{ route('projects.index') }}" class="btn btn-primary btn-lg" type="button">Projects</a>
        </div>
    </div>
    
    <div class="content">
        <div class="container">
            <p>My name is Luis Mocha, lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum necessitatibus, enim sunt ipsam ab voluptates pariatur consectetur. Beatae autem quis, illum ea debitis exercitationem esse, perferendis eius non iste est?
            Laboriosam facilis voluptates iure repellat quisquam ut soluta rem rerum ipsum qui suscipit accusantium, veritatis cum laudantium quas, veniam libero culpa et ad sit. Provident perspiciatis nihil non eius? Dolor?
            Nulla amet accusantium consequatur perspiciatis possimus, placeat laborum fugiat sed! Eaque quasi quidem amet aliquam quae accusamus earum pariatur sunt temporibus? Commodi, natus! Odio numquam incidunt quae quibusdam. Placeat, laudantium.
            Numquam aliquam eligendi delectus vero ut iusto laboriosam doloribus, animi in, cupiditate, modi adipisci quam temporibus labore debitis veniam cumque vitae cum veritatis doloremque sapiente. Eos quod commodi vitae repudiandae!
            Omnis, soluta quaerat suscipit voluptates consequuntur magnam harum perferendis repellat non nam magni. Quis soluta labore minima nihil facilis architecto explicabo illo doloremque quam a. Culpa odit molestias cupiditate quo!</p>
        </div>
    </div>
</div>

@endsection