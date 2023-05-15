@extends('templates.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 mb-20">
            <div class="card-box mb-30">
                <div class="pd-20">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>



    @push('js')
        {{ $dataTable->scripts() }}
    @endpush
@endsection
