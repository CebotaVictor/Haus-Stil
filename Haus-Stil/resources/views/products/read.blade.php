@extends('layout.emptylayout')
@section('content')
<div class="container mt-4">
        <h2 class="mb-4">Categories List</h2>

        <!-- Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>CategoryName</th>
                    <th>ImageName</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $prod)
                <tr>
                    <td>{{ $prod->id }}</td>
                    <td>{{ $prod->name }}</td>
                    <td>{{ $prod->price }}</td>
                    <td>{{ $prod->description }}</td>
                    <td>{{ $prod->categoryName }}</td>
                    <td>{{ $prod->categoryName }}</td>
                    <td>{{ $prod->imageName }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('prod.edit', $prod->id) }}" class="btn btn-primary btn-sm">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('prod.delete', $prod->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection