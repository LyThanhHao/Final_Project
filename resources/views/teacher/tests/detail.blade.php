@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 style="color: aliceblue;">List of results of "{{ $test->test_name }}"</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="max-width: 20px;">No.</th>
                            <th style="max-width: 70px;">Student Name</th>
                            <th style="max-width: 50px;">Score</th>
                            <th style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">1</td>
                            <td style="text-align: center;">Ly Thanh Hao</td>
                            <td style="text-align: center;">10</td>
                            <td style="text-align: center; position: relative;">
                                <a href="" class="btn btn-edit"><i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="display: flex; justify-content: center;">
                    <a href="{{ route('teacher.tests.index') }}" class="btn btn-back mb-3">Back to Tests List</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        td {
            font-size: 13px;
        }

        th {
            font-size: 15px;
            text-align: center;
            align-content: center;
        }

        .btn-add {
            background-color: #28a745;
            transition: background-color 0.3s, transform 0.3s;
            color: white;
            border-radius: 1em;
        }

        .btn-add:hover {
            transform: scale(1.05);
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .btn-back {
            background-color: grey;
            transition: background-color 0.3s, transform 0.3s;
            color: white;
            border-radius: 1em;
        }

        .btn-back:hover {
            transform: scale(1.05);
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .btn-edit {
            background-color: green;
            color: white;
            margin-bottom: 10px;
            width: 100%;
            padding: 5px;
            font-size: 13px;
        }

        .btn-edit:hover {
            border: 1px solid black;
            background-color: white;
            color: black;
        }

        .btn-delete {
            background-color: red;
            color: white;
            width: 100%;
            padding: 5px;
            font-size: 13px;
        }

        .btn-delete:hover {
            border: 1px solid black;
            background-color: white;
            color: black;
        }

        .btn-toggle {
            background-color: transparent;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .btn-toggle i {
            color: #007bff;
        }

        .btn-toggle.active i {
            color: red;
        }

        .action-buttons {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }

        .card-header {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }
    </style>

    <script>
        function toggleActions(button) {
            const actionButtons = button.nextElementSibling;
            const isVisible = actionButtons.style.display === 'block';
            actionButtons.style.display = isVisible ? 'none' : 'block';
            button.classList.toggle('active', !isVisible);
            button.innerHTML = isVisible ? '<i class="bi bi-list"></i>' : '<i class="bi bi-x"></i>';
        }
    </script>
@endsection()
