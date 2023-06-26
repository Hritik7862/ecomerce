@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            OrderManagement
                            <a href="{{ url('items') }}" class="btn btn-primary btn-sm">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="/items" method="post" enctype="multipart/form-data" required>
                            @csrf
                            @method('post')
                            <div class="form-group row">
                                <label for="itemName">Name</label>
                                <input type="text" name="itemName" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <label for="itemQuantity">Item Quantity</label>
                                <input type="number" name="itemQuantity" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <label for="itemType">Item Type</label>
                                <input type="text" name="itemType" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <label for="itemImage">Item Image</label>
                                <input type="file" name="itemImage" class="form-control-file" required>
                            </div>
                            <div class="form-group row">
                                <label for="PurchasingPrice">Purchasing Price</label>
                                <input type="number" name="PurchasingPrice" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <label for="SellingPrice">Selling Price</label>
                                <input type="number" name="SellingPrice" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mb-5">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
