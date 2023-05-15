@extends('templates.admin')
@section('content')
    <div class="row">
        <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scanModalLabel">Scan Barcode</h5>
                        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8 col-sm-12 mb-20 col-lg-12">
            <div class="card-box `">
                <div class="pd-20">
                    <form action="{{ route('app.link.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group mb-3 row">
                            <label class="col-12  col-form-label">Product Code <span class="text-danger">*</span></label>
                            <div class="col-12 ">
                                <div class="input-group mb-0">
                                    <input type="text" class="form-control number-input" name="product_code"
                                        placeholder="Insert Product Code" required>
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary border border-grey btn-sm px-3 ml-2"
                                            type="button" data-toggle="modal" data-target="#scanModal"><i
                                                class="bi bi-upc-scan"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class="col-lg-6 col-md-6 col-sm-12 space-bottom">
                                <div class="row">
                                    <label class="col-12  col-form-label">Product Name<span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="product_name"
                                            placeholder="Insert Product Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <label class="col-12  col-form-label">Product Type <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <select class="form-control custom-select" name="product_type" required>
                                            <option value="">-- Select Option --</option>
                                            <option value="Production">Production</option>
                                            <option value="Consumption">Consumption</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class="col-lg-6 col-md-6 col-sm-12 space-bottom">
                                <div class="row">
                                    <label class="col-12  col-form-label">Product Weight</label>
                                    <div class="col-12">
                                        <div class="input-group mb-0">
                                            <input type="text" class="form-control" name="product_weight"
                                                placeholder="Insert Product Weight">
                                            <div class="input-group-append ">
                                                <select name="product_unit" class="custom-select select-append">
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
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <label class="col-12  col-form-label">Product Brand</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="product_brand"
                                            placeholder="Insert Product Brand">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class="col-lg-6 col-md-6 col-sm-12 space-bottom">
                                <div class="row">
                                    <label class="col-12  col-form-label">Stock <span class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <input type="text" class="form-control number-input" name="stock"
                                            placeholder="Insert Product Stock" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <label class="col-12  col-form-label"> Product Price <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend border-grey border rounded-left-span ">
                                                <span class="input-group-text bg-light-gray">Rp.</span>
                                            </div>
                                            <input type="number" class="form-control" name="price"
                                                placeholder="Insert Product Price" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-2 d-flex justify-content-end">
                                <button class="btn btn-primary " type="submit"><i class="bi bi-save"></i>
                                    Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    @push('js')

    @endpush
@endsection
