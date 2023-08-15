<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
   
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script>
    $(document).ready(function () {
        // alert();

        $(document).on('click', '.add_product_hide_error', function() {
            $('.errMsgContainer').html("");
            
        });


        $(document).on('click', '.add_product', function(e) {
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();

            $.ajax({
                url:"{{ route('add.product') }}",
                method:'post',
                data:{name:name, price:price},
                success:function(res){
                    if(res.status=='success'){
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        $('.errMsgContainer').html("");

                        Command: toastr["success"]("Product Added Successfully")

                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    }
                }, error:function(err){
                    let error = err.responseJSON;
                    $('.errMsgContainer').html("");
                    // $('.errMsgContainer').load(location.href+' .errMsgContainer');
                    $.each(error.errors, function(index, value){
                        $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>')
                    });
                    
                }
                
            });
        });

        // Show product value in the form
        $(document).on('click', '.update_product_form', function() {
            $('.updateErrMsgContainer').html("");
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');

            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_price').val(price);

        });

        // Updating Product
        $(document).on('click', '.update_product', function(e) {
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_name = $('#up_name').val();
            let up_price = $('#up_price').val();

            $.ajax({
                url:"{{ route('update.product') }}",
                method:'post',
                data:{up_id:up_id, up_name:up_name, up_price:up_price},
                success:function(res){
                    if(res.status=='success'){
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        $('.updateErrMsgContainer').html("");

                        Command: toastr["success"]("Product Updated Successfully!")

                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    }
                }, error:function(err){
                    let error = err.responseJSON;
                    $('.updateErrMsgContainer').html("");
                    $.each(error.errors, function(index, value){
                        
                        $('.updateErrMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>')
                    });
                }
            });
        });

        // delete product
        $(document).on('click', '.delete_product', function(e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            // alert(product_id)

            if(confirm('Are you sure to delete this product')){
                    $.ajax({
                    url:"{{ route('delete.product') }}",
                    method:'post',
                    data:{product_id:product_id},
                    success:function(res){
                        if(res.status=='success'){
                            $('.table').load(location.href+' .table');
                            Command: toastr["success"]("Product Deleted Successfully!")

                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                        }
                    }, 
                });
            }
            
        });

        // Pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            product(page)
            
        });

        function product(page) {
            $.ajax({
                    url:"/pagination/paginate-data?page="+page,
                    success:function(res){
                        console.log('rees ', res)
                        $('.table-data').html(res);
                    }
            })
        }

        // Search Product
        $(document).on('keyup', function(e) {
            e.preventDefault();
            let search_string = $('#search').val();
            console.log(search_string);
            
            $.ajax({
                url:"{{ route('search.product') }}",
                method:'GET',
                data:{search_string:search_string},
                success:function(res) {
                    $('.table-data').html(res);
                    if(res.status == 'nothing_found') {
                        $('.table-data').html('<span class="text-danger">'+'Nothing Found!'+'</span>');
                    }
                }
            })
        });

        
    });
</script>