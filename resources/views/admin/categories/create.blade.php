@extends('layouts/adminLO')

@section('main')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-center"> Create a new Category</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="cat_name">Name of Category</label>
              <input type="text" class="form-control" id="cat_name" name="cat_name" required>
            </div>
            <div class="form-group mb-0">
              <label for="cat_image">Category Image</label>
              <br>
              <img id="current-image" src="{{ old('cat_image') ? asset('uploads/category_image/' . old('cat_image')) : '' }}" alt="" class="img-thumbnail mt-2" style="width: 100px; height: 100px; margin-bottom: 10px;">
              @error('cat_image')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <input type="file" class="form-control mb-3" id="cat_image" name="cat_image" onchange="previewImage(event)">
            <button type="submit" class="btn-add">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection