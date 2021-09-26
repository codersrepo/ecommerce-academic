@extends('crude.design')
@section('content')
<a href="{{ route('crude.index') }}">List Products</a>

<form action="{{ route('crude.store') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Name</label>
      <input type="string" class="form-control"  name ="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Subject</label>
      <input type="string" name="subject" class="form-control"  name  = "name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
