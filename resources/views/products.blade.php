<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ajax CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

</head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2 class="my-5 text-center">Ajax CRUD Table</h2>
                <a href="" class="btn btn-success my-3 add_product_hide_error" data-bs-toggle="modal" data-bs-target="#addModal">Add Product</a>
                <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="Search Product">
                <div class="table-data">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key=>$product)
                        <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="" 
                            class="btn btn-success update_product_form"
                            data-bs-toggle="modal" 
                            data-bs-target="#updateModal"
                            data-id="{{ $product->id }}" 
                            data-name="{{ $product->name }}" 
                            data-price="{{ $product->price }}"
                            >
                            <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="" class="btn btn-danger delete_product"
                            data-id="{{ $product->id }}"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('update_product_modal')
    @include('add_product_modal')
    @include('product_js')
    {!! Toastr::message() !!}
</body>
</html>