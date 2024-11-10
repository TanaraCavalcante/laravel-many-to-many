@extends("layouts.app")

@section("content")
<section id="index">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-10">
                <table class="table table-striped bg-white">
                    <thead>
                        <tr>
                            <th scope="col">Project Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>

                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->title}}</th>
                            <td class="px-2">{{ $project->description}}</td>
                            <td>{{ $project->category}}</td>
                            <td class="col-2">
                                <a href="{{ route("admin.show", $project->id)}}" class="btn btn-sm btn-outline-warning">Show</a>
                                <a href="{{ route("admin.edit", $project->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
                                {{-- implemento um form com um botao dentro de modo que este form enviara o meu metodo diretamente ao db, executando a oredem de deletar nesse caso. --}}
                                <form action="{{ route("admin.delete", $project->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    </tbody>
                </table>
                    <h1>No projects are avaliable at the moment...</h1>
                    @endforelse
            </div>
        </div>
    </div>
</section>

@endsection
