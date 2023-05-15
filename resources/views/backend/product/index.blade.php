@extends('templates.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 mb-20">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <table class="data-table-simple table ">
                        <thead>
                            <tr class="text-secondary">
                                <th class="sorting_asc_disabled sorting_desc_disabled table-plus datatable-nosort">Product
                                </th>
                                <th class="sorting_asc_disabled sorting_desc_disabled">Type</th>
                                <th class="sorting_asc_disabled sorting_desc_disabled">Weight</th>
                                <th class="sorting_asc_disabled sorting_desc_disabled">Brand</th>
                                <th class="sorting_asc_disabled sorting_desc_disabled">Stock</th>
                                <th class="sorting_asc_disabled sorting_desc_disabled">Price</th>
                                <th class="sorting_asc_disabled sorting_desc_disabled text-center  dt-head-center">Status
                                </th>
                                <th class="sorting_asc_disabled sorting_desc_disabled datatable-nosort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="table-plus">
                                        <p>{{ $product->product_code }}</p><small
                                            class="text-blue">{{ $product->product_name }}</small>
                                    </td>
                                    <td>{{ $product->product_type }}</td>
                                    <td>{{ $product->product_weight . ' ' . $product->product_unit }}</td>
                                    <td>{{ $product->product_brand }}</td>
                                    <td><span class="p-2 bg-light-gray rounded border  mr-2"><i
                                                class="bi bi-box-seam "></i></span>
                                        {{ $product->stock }}
                                    </td>
                                    <td><span class="p-2 bg-green rounded border mr-2"><i
                                                class="bi bi-currency-dollar "></i></span>Rp.
                                        {{ number_format($product->price, 2, ',', '.') }}

                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="{{ $product->product_status == 'avaible' ? 'bg-green  rounded border' : 'bg-light-orange  rounded border' }}  p-2">{{ ucfirst($product->product_status) }}</span>
                                    </td>
                                    <td>
                                        <button
                                            class=" btn btn-edit btn-icons rounded-circle  btn-sm bg-light-gray border mr-1"
                                            id="editModalBtn" data-toggle="modal"
                                            data-target="#editModal_{{ $product->id }}" data-id="{{ $product->id }}"
                                            data-url="{{ route('auth.product.update', $product) }}"
                                            onClick='handleEdit(this)'><small
                                                class="font-weight-bold bi bi-pencil"></small></button>
                                        <button class="btn btn-edit btn-icons rounded-circle  btn-sm bg-light-gray border "
                                            id="deleteModalBtn" data-toggle="modal"
                                            data-target="#deleteModal_{{ $product->id }}" data-id="{{ $product->id }}"
                                            data-url="{{ route('auth.product.destroy', $product) }}"
                                            onClick='handleDelete(this)'><small
                                                class="font-weight-bold bi bi-x-lg"></small></button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Delete-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="formDelete" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="modal-body">
                                Are you sure want to delete?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger"><i
                                        class="bi bi-trash-fill mr-2"></i>Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit-->
            <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="formEdit" method="POST">
                            @method('PUT')
                            @csrf
                            {{ Form::hidden('id', '', ['id' => 'id', 'class' => 'id']) }}
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Product Code</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text" placeholder="" name="product_code" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Product Name</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text" placeholder="" name="product_name" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Product Type</label>
                                    <div class="col-sm-12 col-md-8">
                                        <select class="custom-select col-12">
                                            <option value="1">Production</option>
                                            <option value="2">Consupmtion</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-sm-12 col-md-4 col-form-label">Product Weight</label>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="product_weight">
                                            <div class="input-group-append ">
                                                <select name="product-unit" class="custom-select select-append">
                                                    <option value="kg">Kilogram</option>
                                                    <option value="g">Gram</option>
                                                    <option value="ml">Miligram</option>
                                                    <option value="oz">Ons</option>
                                                    <option value="l">Liter</option>
                                                    <option value="ml">Mililiter</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Product Brand</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text" placeholder=""
                                            name="product_brand" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Stock</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="number" placeholder="" name="stock" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Price</label>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend border-grey border rounded-left-span ">
                                                <span class="input-group-text bg-light-gray">Rp.</span>
                                            </div>
                                            <input type="number" class="form-control" name="price">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i
                                        class="bi bi-save-fill mr-2"></i>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>



    @push('js')
        <script>
            function handleDelete(target) {
                let formDelete = document.querySelector("#formDelete");
                let deleteModal = document.querySelector("#deleteModal");
                const deleteModalBtn = document.querySelectorAll("#deleteModalBtn");
                deleteModalBtn.forEach((data) => {
                    data.addEventListener("click", function(e) {
                        deleteModal.setAttribute("id", `deleteModal_${data.dataset.id}`);
                        formDelete.setAttribute("action", data.dataset.url);
                    });
                });
            }

            function handleEdit(target) {
                let formEdit = document.querySelector("#formEdit");
                let editModal = document.querySelector("#editModal");
                const editModalBtn = document.querySelectorAll("#editModalBtn");
                editModalBtn.forEach((data) => {
                    data.addEventListener("click", function(e) {
                        editModal.setAttribute("id", `editModal_${data.dataset.id}`);
                        formEdit.setAttribute("action", data.dataset.url);
                    });
                });
            }

            $(document).on('click', '#editModalBtn', function() {
                var data_value = $(this).data('id');
                $.ajax({
                    method: "GET",
                    url: "{{ url('/auth/product/') }}/" + data_value + "/edit",
                    success: function(response) {
                        $('input[name=id]').val(response.product.id);
                        $('input[name=product_code]').val(response.product.product_code);
                        $('input[name=product_name]').val(response.product.product_name);
                        $('input[name=product_brand]').val(response.product.product_brand);
                        $('input[name=stock]').val(response.product.stock);
                        $('input[name=price]').val(response.product.price);
                        $('input[name=product_weight]').val(response.product.product_weight);
                        $('select[name=product_type] option[value="' + response.product.product_type + '"]')
                            .prop('selected', true);
                        $('select[name=product_unit] option[value="' + response.product.product_unit + '"]')
                            .prop(
                                'selected', true);
                        validator.resetForm();
                    }
                });
            });
        </script>
    @endpush
@endsection
