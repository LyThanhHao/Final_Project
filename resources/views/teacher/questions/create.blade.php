@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3>Create a new question</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.questions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="test_id" value="{{ $test->id }}">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" name="question" placeholder="Enter question" value="{{ old('question') }}" required>
                        @error('question')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="a">A:</label>
                            <input type="text" class="form-control" id="a" name="a" value="{{ old('a') }}" required>
                            @error('a')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="b">B:</label>
                            <input type="text" class="form-control" id="b" name="b" value="{{ old('b') }}" required>
                            @error('b')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="c">C:</label>
                            <input type="text" class="form-control" id="c" name="c" value="{{ old('c') }}" required>
                            @error('c')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="d">D:</label>
                            <input type="text" class="form-control" id="d" name="d" value="{{ old('d') }}" required>
                            @error('d')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <select class="form-control" id="answer" name="answer" required>
                            <option value="a" {{ old('answer') == 'a' ? 'selected' : '' }}>A</option>
                            <option value="b" {{ old('answer') == 'b' ? 'selected' : '' }}>B</option>
                            <option value="c" {{ old('answer') == 'c' ? 'selected' : '' }}>C</option>
                            <option value="d" {{ old('answer') == 'd' ? 'selected' : '' }}>D</option>
                        </select>
                        @error('answer')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('teacher.tests.index') }}" class="btn btn-secondary">Back to list</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

