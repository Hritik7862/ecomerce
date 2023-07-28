@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header " >
                    <h3>
                        OrderManagement
                        <a href="{{ url('items/create') }}" class="btn btn-warning btn-block custom-button shadow">Create</a>

                    </h3>
                    
                </div>
                @if (Session::has('success'))
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
              
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ItemName</th>
                            <th>ItemQuantity</th>
                            <th>ItemType</th>
                            <th>ItemImage</th>
                            <th>PurchasingPrice</th>
                            <th>SellingPrice</th>
                            <th>Description</th>
                            <th>Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->itemName }}</td>
                            <td>{{ $item->itemQuantity }}</td>
                            <td>{{ $item->itemType }}</td>
                            <td>
                                @if ($item->itemImage)
                                  <img src="{{ asset('storage/images/' . $item->itemImage) }}" alt="Item Image" width="55">
                                @else
                                No Image
                                @endif
                            </td>
                            <td>{{ $item->PurchasingPrice }}</td>
                            <td>{{ $item->SellingPrice }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a class="btn btn-success" href="{{ route('items.edit', $item->id) }}">Edit</a>
                            </td>
                            <td>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" 
                             onsubmit="return confirmDelete(event)">
                           <button type="submit" class="btn btn-danger">Delete</button>
                            @csrf
                           @method('DELETE')
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
  
@endsection

<script>
    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this item!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
                showSuccessMessage();
            }
        });
    }

    function showSuccessMessage() {
        Swal.fire({
            title: "Success!",
            text: "The item has been deleted successfully.",
            icon: "success",
            showConfirmButton: false,
            timer: 2000
        });
    }
</script>















