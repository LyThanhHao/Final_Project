@extends('layouts/adminLO')

@section('main')
<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Category</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('admin.categories.update', ['category' => $category->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="category_name">Name of Category</label>
              <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}">
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option style="color: black;" value="0" {{ $category->status == '0' ? 'selected' : '' }}>Hidden</option>
                <option style="color: black;" value="1" {{ $category->status == '1' ? 'selected' : '' }}>Public</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection