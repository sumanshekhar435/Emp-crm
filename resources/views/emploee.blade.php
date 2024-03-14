@extends('layouts.app')
@section('content')
    <div class="conainer mt-5">
        <div class="row justify-content-center mb-4">
            <div class="col-md-5">
                <h1>Employee Management</h1>
            </div>
            <div class="col-md-5 mt-2" style="text-align: right">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#empCreateModal">Add
                    Emp</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('msg'))
                    <div class="alert alert-success text-center">
                        {{ session('msg') }}
                    </div>
                @endif
                <div id="message" class="alert alert-success text-center d-none"></div>
                <table id="empTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Salary</th>
                            <th>Gender</th>
                            <th>Hobby</th>
                            <th>Start date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBodyContents">
                        @foreach ($emp as $item)
                            <tr class="tableRow" data-id="{{ $item->id }}">
                                <td class="pl-3"><i class="fa fa-sort"></i></td>
                                <td><img src="{{asset($item->image)}}" style="max-width: 40px; max-height: 40px; object-fit: cover; border-radius: 50%;" alt=""> {{ $item->name }}</td>
                                <td>{{ $item->designation }}</td>
                                <td>{{ $item->salary }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->hobby }}</td>
                                <td>{{ date('d-m-y', strtotime($item->created_date)) }}</td>
                                <td class="text-center">
                                    <span style="cursor: pointer; margin-right:5px" class="editEmp"
                                        data-id="{{ $item->id }}" data-toggle="modal" data-target="#empEditModal"><i
                                            class="fa fa-edit"></i></span>
                                    <span style="cursor: pointer" class="confirmationEmpDelete"
                                        data-id="{{ $item->id }}" data-toggle="modal"
                                        data-target="#confirmationDeleteModal"><i class="fa fa-trash text-danger"
                                            aria-hidden="true"></i></span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Salary</th>
                            <th>Gender</th>
                            <th>Hobby</th>
                            <th>Start date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="empCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="empCreatForm">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Emp Name</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control mt-2 mb-2" placeholder="Enter Name">
                                            <small id="name_error" class="form-text text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation">Designation</label>
                                            <input type="text" id="designation" name="designation"
                                                class="form-control mt-2 mb-2" placeholder="Enter Designation">
                                            <small id="designation_error" class="form-text text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="salary">Salary</label>
                                            <input type="text" id="salary" name="salary"
                                                class="form-control mt-2 mb-2" placeholder="Enter Salary">
                                            <small id="salary_error" class="form-text text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender" value="Male">
                                                        <label class="form-check-label" for="male">Male</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender" value="Female">
                                                        <label class="form-check-label" for="female">Female</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender" value="Other">
                                                        <label class="form-check-label" for="other">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="hobby">Hobby</label>
                                            <input type="text" id="hobby" name="hobby"
                                                class="form-control mt-2 mb-2" placeholder="Enter Hobby">
                                        </div>
                                        <div class="form-group">
                                            <label for="designation">Emp Image</label>
                                            <input type="file" id="image" name="image"
                                                class="form-control mt-2 mb-2">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary create_emp">Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Confirmation employee delete modal --}}
    <div class="modal fade" id="confirmationDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure You want to delete Employee ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-danger emp_delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Emp --}}
    <div class="modal fade" id="empEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('emp-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="emp_id" id="empId">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Emp Name</label>
                                            <input type="text" id="edit_name" name="name"
                                                class="form-control mt-2 mb-2" placeholder="Enter Name">
                                            <small id="name_error" class="form-text text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation">Designation</label>
                                            <input type="text" id="edit_designation" name="designation"
                                                class="form-control mt-2 mb-2" placeholder="Enter Designation">
                                            <small id="designation_error" class="form-text text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="salary">Salary</label>
                                            <input type="text" id="edit_salary" name="salary"
                                                class="form-control mt-2 mb-2" placeholder="Enter Salary">
                                            <small id="salary_error" class="form-text text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input edit_gender" type="radio" name="gender"
                                                            id="edit_gender_male" value="Male">
                                                        <label class="form-check-label" for="edit_gender_male">Male</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input edit_gender" type="radio" name="gender"
                                                            id="edit_gender_female" value="Female">
                                                        <label class="form-check-label" for="edit_gender_female">Female</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input edit_gender" type="radio" name="gender"
                                                            id="edit_gender_other" value="Other">
                                                        <label class="form-check-label" for="edit_gender_other">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="hobby">Hobby</label>
                                            <input type="text" id="edit_hobby" name="hobby"
                                                class="form-control mt-2 mb-2" placeholder="Enter Hobby">
                                        </div>
                                        <div class="form-group">
                                            <label for="designation">Emp Image</label>
                                            <input type="file" id="edit_image" name="image"
                                                class="form-control mt-2 mb-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update_emp">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#empTable').DataTable();
            $("#tableBodyContents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {

                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');

                $('tr.tableRow').each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('emp-reorder') }}",
                    data: {
                        order: order,
                        _token: token
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });
            }

            $('.create_emp').click(function() {
                var name = $('#name').val();
                var designation = $('#designation').val();
                var salary = $('#salary').val();
                var gender = $('input[name="gender"]:checked').val();
                var hobby = $('#hobby').val();
                var image = $('#image')[0].files[0];
                var data = new FormData();
                data.append('name', name);
                data.append('designation', designation);
                data.append('salary', salary);
                data.append('gender', gender);
                data.append('hobby', hobby);
                data.append('image', image);

                $.ajax({
                    type: "post",
                    url: "{{ route('emp-store') }}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        $('#empCreateModal').modal('hide');
                        $('#message').text(response.message);
                        $('#message').removeClass('d-none');
                    },
                    error: function(error) {
                        var response = $.parseJSON(error.responseText);
                        $.each(response.errors, function(key, val) {
                            $('#' + key + "_error").text(val[0]);
                        })
                    }
                });
            })

            $('.confirmationEmpDelete').click(function() {
                var emp_id;
                emp_id = $(this).data('id');
                console.log(emp_id);
                $('.emp_delete').click(function() {
                    $.ajax({
                        type: "post",
                        url: "{{ route('emp-delete') }}",
                        data: {
                            id: emp_id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);
                            $('#confirmationDeleteModal').modal('hide');
                            $('tr[data-id="' + emp_id + '"]').remove();
                            $('#message').text(response.message);
                            $('#message').removeClass('d-none');
                        }
                    });
                })
            });

            $('.editEmp').click(function() {
                var emp_id;
                emp_id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ route('emp-edit') }}",
                    data: {
                        id: emp_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response.data.name);
                        $('#empId').val(response.data.id);
                        $('#edit_name').val(response.data.name);
                        $('#edit_designation').val(response.data.designation);
                        $('#edit_salary').val(response.data.salary);
                        $('.edit_gender[value="' + response.data.gender + '"]').prop('checked', true);
                        $('#edit_hobby').val(response.data.hobby);
                    }
                });
            })
        });
    </script>
@endsection
