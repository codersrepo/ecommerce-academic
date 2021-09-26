@extends('crude.design')

@section('content')
<a href="{{ route('crude.create') }}">Create Products</a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $data_indiv)
      <tr>
        <th scope="col">{{$loop->iteration}}</th>
        <td>{{ $data_indiv->name }}</td>
        <td>{{ $data_indiv->subject }}</td>
      </tr>
      @endforeach

    </tbody>
  </table>
  @endsection
