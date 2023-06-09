@extends('admin_main')
@section('title', 'Home')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-5 w-full  px-4 py-3 vendor-title">
  <div class="d-flex justify-content-center align-items-center">
    <i class="bi bi-back h4 me-3 vendor-icon "></i>
    <h3>User</h3>
  </div>
    <a href="{{ url('create_user') }}" class="btn btn-success text-white">Create New User</a>
</div>

@if ($user->isEmpty())
    <p>No User. Please add one.</p>
    <!-- <div >
        <select name="role" id="" class="px-1 py-1">
            <option selected>Search by Role</option>
            <option value="cutomer">cutomer</option>
            <option value="vendor">vendor</option>
            <option value="admin">admin</option>
        </select>
    </div> -->
@else

    <table class="table mt-5 table-borderless table-hover table_style">
        <thead class="thead-light header_color text-black">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Phone Number</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
        <tbody class="t">
      <div class="d-none">
      {{ $i= 1}}
       </div>
            @foreach($user as $user_data)
                <tr>
                    <td>{{ $i++}}</td>
                    <td>{{ $user_data->username }}</td>
                    <td>{{ $user_data->email }}</td>
                    <td>{{ $user_data->role }}</td>
                    <td>{{ $user_data->phone_number }} </td>
                    <td class="text-center">
                        <a href="{{url('user/'.$user_data->id.'/edit')}}" class="btn btn-sm btn-light">
                            <i class="bi bi-pencil text-primary font-weight-bold p-3 "> Edit</i>
                        </a>
                        <a href="{{url('delete_user', $user_data->id)}}"class="btn btn-sm btn-light">
                            <i class="bi bi-trash text-danger"> Delete</i>
                        </a>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>

@endif


@endsection


