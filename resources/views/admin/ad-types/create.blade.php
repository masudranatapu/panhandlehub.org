@extends('admin.layouts.app')
@section('style')

@endsection
@section('title')
    {{ __('Ad Type') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('Ad Type') }}</h3>
                        <a href="{{ route('adtypes.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('adtypes.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <x-forms.label name="Ad Type Name" required="true" class="col-sm-3 col-form-label" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('name') }}" name="name" type="text"
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
                                        <select name="is_paid"
                                            class="form-control @error('is_paid') is-invalid @enderror"
                                            style="width: 100%;" id="is_paid" onchange="isPaid()">
                                           <option value="0">No</option>
                                           <option value="1">Yes</option>

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
                                            <input value="{{ old('amount') }}" name="amount" type="text"
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
                                            <i class="fas fa-plus"></i>&nbsp; {{ __('create') }}
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
      function isPaid() {
         var is_paid = document.getElementById("is_paid");
         var amount = document.getElementById("amount");
         amount.style.display = is_paid.value == "1" ? "block" : "none";
      }
   </script>
@endsection
