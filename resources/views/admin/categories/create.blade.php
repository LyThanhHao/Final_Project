@extends('layouts/adminLO')

@section('main')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h4 class="card-title"> Create a new Category</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="category_name">Name of Category</label>
              <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
