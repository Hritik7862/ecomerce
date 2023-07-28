@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Order Management
                        <a href="{{url('items')}}" class="btn btn-primary btn-sm">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Add an ID to the form -->
                    <form action="/items/{{$info['id']}}" method="post" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label for="itemName">Name</label>
                            <input type="text" name="itemName" class="form-control" value="{{$info['itemName']}}">
                        </div>
                        <div class="form-group row">
                            <label for="itemQuantity">Item Quantity</label>
                            <input type="number" name="itemQuantity" class="form-control" value="{{$info['itemQuantity']}}">
                        </div>
                        <div class="form-group row">
                            <label for="itemType">Item Type</label>
                            <input type="text" name="itemType" class="form-control" value="{{$info['itemType']}}">
                        </div>
                        <div class="form-group row">
                            <label for="itemImage">Item Image</label>
                            <img src="{{ asset('storage/images/' . $info->itemImage) }}" alt="Item Image" style="max-width: 200px; max-height: 200px;">
                            <input type="file" name="itemImage" class="form-control-file" value="{{$info['itemImage']}}">
                        </div>
                        <div class="form-group row">
                            <label for="purchasingPrice">Purchasing Price</label>
                            <input type="number" name="PurchasingPrice" class="form-control" value="{{$info['PurchasingPrice']}}">
                        </div>
                        <div class="form-group row">
                            <label for="sellingPrice">Selling Price</label>
                            <input type="number" name="SellingPrice" class="form-control" value="{{$info['SellingPrice']}}">
                        </div>
                        <div class="form-group row">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" value="{{$info['description']}}">
                        </div>
                        <button class="btn btn-primary">Go</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function confirmSubmit() {
        return confirm("Are you sure you want to submit this form?");
    }
</script>

@endsection



