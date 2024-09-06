@extends('layouts/adminLO')

@section('main')
<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-center">Table of Categories</h3>
        </div>
        <div class="card-body">
          <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create a new Category</a>
          <div>
            <table class="table" id="">
              <thead class="text-primary">
                <tr>
                  <th>Category Name</th>
                  <th>Status</th>
                  <th style="text-align: center;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <td>{{ $category->cat_name }}</td>
                  <td>{{ $category->status == 0 ? 'Hidden' : 'Publish' }}</td>
                  <td style="text-align: center;">
                    <a href="{{ route('admin.categories.edit', $category->id) }}"><i class="bi bi-pencil-square" style="color: white;"></i></a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="confirmDelete(event)" style="border: none; background: border-box; color: white; margin-left: 15px;"><i class="bi bi-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection()
