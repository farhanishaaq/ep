@extends('layouts.master')
<!--========================================================
                          TITLE
=========================================================-->
@section('title')
    Manage Employees
@stop

@section('redBar')
<div class = "user_logo">
    <div class="header_1 wrap_3 color_3 login-bar">Easy Physician
        {{--<div class="col-md-12 mL25 taL">Easy Physician</div>--}}
    </div>
</div>
@stop

@section('sliderContent')
@stop
<!--========================================================
                          CONTENT
=========================================================-->
@section('content')
<div class="container-fluid mT20">
    <h1 class="mT10 mB0 c3" style="font-family: 'Marvel'">Users List</h1>
    <hr class="w100p fL mT0" />
    <section id="form-Section">
        <!--========================================================
                                 Data Table
        =========================================================-->
        {{ link_to_route('employees.create', 'Register Employee', '', ['class' => 'btn_1'])}}
        <table id="example" class="mT20 table table-hover .table-striped display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{{ $employee->name }}}</td>
                        <td>{{{ $employee->email }}}</td>
                        <td>{{{ $employee->gender }}}</td>
                        <td>{{{ $employee->role }}}</td>
                        <td>{{{ $employee->branch }}}</td>
                        <td>{{{ $employee->status }}}</td>
                        <td>
                        {{ link_to_route('employees.show', 'View', [$employee->id], ['class' => 'btn_1 mT5',])}}
                        @if($employee->role != 'Administrator' && $employee->role != 'Super User')
                            {{ link_to_route('employees.edit', 'Edit', [$employee->id], ['class' => 'btn_1 mT5'])}}
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links('partials.pagination') }}
    </section>
</div>

@stop

