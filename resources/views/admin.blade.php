@extends('layouts.app')

@section('content')

<div class="container mt-4">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>User List</h1>

    <form id="makeAdminForm" action="{{ route('update.admin.status') }}" method="POST">
        @csrf
        <div class="d-flex justify-content-between mb-3">
            <div>
            </div>
            <div>
            <button type="button" class="btn btn-primary custom-button shadow" onclick="showConfirmation()">Make Admin</button>

                <a href="/items/create" class="btn btn-primary custom-button shadow" onclick="show()">Create Item</a>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Name</th>   
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Profile Picture</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        <input type="checkbox" name="selected_users[]" value="{{ $user->id }}">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobilenumber }}</td>
                    <td>
                        <img src="{{ asset('storage/image/' . $user->profile_picture) }}" alt="Profile Picture" style="width: 50px; height: 50px; border-radius: 50%;">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>

<script>
    function showConfirmation() {
        if (confirm("Are you sure you want to make the selected users admin?")) {
            document.getElementById("makeAdminForm").submit();
        } else {

        }
    }
    function show(){
        if(confirm("Are you sure Create Item?")){
            document.getElementById("CreateItemForm").submit();
        }
    }
</script>

@endsection
