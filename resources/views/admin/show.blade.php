@extends("layouts.app")

@section("content")
<section class="row">
    <div class="card container p-5 my-5 col-6" >
        <div class="card-body">
        <h2 class="card-title">{{$project->title}}</h2>
        <h5 class="card-text mb-4">{{$project->description}}</h5>
       {{-- Relaçao many-to-many, ver essa conexao com metodo with em controller --}}
        <p class="card-text"><strong>Technology: </strong>
            <ul>
                @foreach ($project->technologies as $technology)
                    <li>{{ $technology->name }}</li>
                @endforeach
            </ul>
        </p>
        <p class="card-text"><strong>Type Project: </strong>{{$project->type->name}}</p>
        <p class="card-text"><strong>GitHub Link: </strong>{{$project->github_link}}</p>
        <p class="card-text"><strong>Creation Date: </strong>{{$project->creation_date}}</p>
        </div>
    </div>
</section>
@endsection
