<div class="pagi-table">
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
