@extends('layouts/adminLO')

@section('main')
<style>
    .btn-update {
      background-color: #28a745;
      transition: background-color 0.3s, transform 0.3s;
      color: white;
      border: 1px solid white;
      padding: 10px 30px;
      margin: 4px 1px;
      display: inline-block;
      border-radius: 10px;
      text-align: center;
      vertical-align: middle;
      font-weight: bold;
    }

    .btn-update:hover {
      background-color: #28a745;
      transform: scale(1.05);
      color: black;
      background-color: white;
      border: 1px solid black;
    }
</style>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
@if (Session::has('fail'))
<script>
    $.toast({
        heading: 'Notification',
        text: "{{ Session::get('fail') }}",
        showHideTransition: 'slide',
        position: 'top-center',
        icon: 'error',
        hideAfter: 5000
    })
</script>
@endif  

@if (Session::has('success'))
<script>
    $.toast({
        heading: 'Notification',
        text: "{{ Session::get('success') }}",
        showHideTransition: 'slide',
        position: 'top-center',
        icon: 'success',
        hideAfter: 5000
    })
</script>
@endif

@endsection()
