@extends('layouts/adminLO')

@section('main')

<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-center">Edit Category</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('admin.categories.update', ['category' => $category->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="cat_name">Name of Category</label>
              <input type="text" class="form-control" id="cat_name" name="cat_name" value="{{ $category->cat_name }}">
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option style="color: black;" value="0" {{ $category->status == '0' ? 'selected' : '' }}>Hidden</option>
                <option style="color: black;" value="1" {{ $category->status == '1' ? 'selected' : '' }}>Public</option>
              </select>
            </div>
            <button type="submit" class="btn-update">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection()
