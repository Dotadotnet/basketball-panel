@extends('layout.admin_template')
@section('content')
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">slug</th>
            <th scope="col">title</th>
            <th scope="col">description</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $d)
            <tr>
                <th scope="row">#</th>
                <td>{{ $d->slug }}</td>
                <td>{{ $d->title }}</td>
                <td>{{ $d->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
