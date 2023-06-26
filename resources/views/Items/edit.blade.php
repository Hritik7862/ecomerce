<!-- {{$info}} -->

@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        OrderManagement
                        <a href="{{url('items')}}" class="btn btn-primary btn-sm">Back</a>
                    </h3>
                    <div class="card-body">
                        
<form action="/items/{{$info['id']}}" method="post" enctype="multipart/form-data" >
    @csrf
    @method('patch')
    <div class="form-group row-3">
        <label for="Name">Name</label>
        <input type="text" name="itemName" value="{{$info['itemName']}}">

    </div>
    <div class="form-group row-3">
    <label for="ItemQuantity">ItemQuantity</label>
<input type="number" name="itemQuantity" value="{{$info['itemQuantity']}}">
</div>
<div class="form-group row-3">
<label for="ItemQuantity"> ItemType</label>
   <input type="text" name="itemType" value="{{$info['itemType']}}">
</div>
<div class="form-group row-3">
<label for="itemImage">itemImage</label>
<img src="{{ asset('storage/images/' . $info->itemImage) }}" alt="Item Image" width="55">
<input type="file" name="itemImage" value="{{$info['itemImage']}}">
</div>
    <div class="form-group row-3">
        <label for="PurchasingPrice">PurchasingPrice</label>
        <input type="number" name="PurchasingPrice" value="{{$info['PurchasingPrice']}}">
    </div>
    <div class="form-group row-3">
        <label for="ShippingPrice">SellingPrice</label>
        <input type="number" name="SellingPrice" value="{{$info['SellingPrice']}}">
    </div>
    <div class="form-group row-3">
        <label for="description">description</label>
    <input type="text" name="description"  value="{{$info['description']}}">
</div>
    <button class="btn btn-primary">go</button>

</form>

        </div>
        </div>
    </div>   
</div>
@endsection
 



