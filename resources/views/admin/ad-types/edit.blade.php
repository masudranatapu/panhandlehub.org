@extends('admin.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }

    </style>
@endsection
@section('title')
    {{ __('Ad Type Edit') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('Ad Type Edit') }}</h3>
                        <a href="{{ route('adtypes.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('adtypes.update',$ad_type->slug) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="Ad Type Name" required="true" class="col-sm-3 col-form-label" />
                                    <div class="col-sm-9">
                                        <input value="{{ $ad_type->name }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('Ad Type Name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-15">
                                    <x-forms.label name="Paid Type" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="is_paid" id="is_paid" onchange="isPaid()"
                                            class="form-control @error('is_paid') is-invalid @enderror"
                                            style="width: 100%;">
                                            <option value="0" {{ $ad_type->is_paid == 0? "selected" : "" }}>No</option>
                                           <option value="1" {{ $ad_type->is_paid == 1? "selected" : "" }}>Yes</option>
                                        </select>
                                        @error('is_paid')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="amount" style="display: none">
                                    <div class="form-group row">
                                        <x-forms.label name="Adtype Amount ($)" required="true" class="col-sm-3 col-form-label" />
                                        <div class="col-sm-9">
                                            <input value="{{ $ad_type->amount }}" name="amount" type="text"
                                                class="form-control @error('amount') is-invalid @enderror"
                                                placeholder="{{ __('Amount') }}">
                                            @error('amount')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus"></i>&nbsp; {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
   <script>
    isPaid()
      function isPaid() {
         var is_paid = document.getElementById("is_paid");
         var amount = document.getElementById("amount");
         amount.style.display = is_paid.value == "1" ? "block" : "none";
      }
   </script>
@endsection
