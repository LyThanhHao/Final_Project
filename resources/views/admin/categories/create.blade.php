@extends('layouts/adminLO')

@section('main')
<style>
  .btn-save {
      width: 9em;
      height: 3em;
      border-radius: 30em;
      font-size: 15px;
      font-family: inherit;
      border: none;
      position: relative;
      overflow: hidden;
      z-index: 1;
      box-shadow: 3px 3px 6px #c5c5c5,
          -3px -3px 6px #ffffff;
      border: solid 1px black;
  }

  .btn-save::before {
      content: '';
      width: 0;
      height: 3em;
      border-radius: 30em;
      position: absolute;
      top: 0;
      left: 0;
      background-image: linear-gradient(to right, #c10fd8 0%, #f9f047 100%);
      transition: .5s ease;
      display: block;
      z-index: -1;
  }

  .btn-save:hover::before {
      width: 9em;
  }
</style>

<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-center"> Create a new Category</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="cat_name">Name of Category</label>
              <input type="text" class="form-control" id="cat_name" name="cat_name" required>
            </div>
            <button type="submit" class="btn-save">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection()
