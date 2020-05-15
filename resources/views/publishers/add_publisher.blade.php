@extends('master')

@section('title_header', trans('publishers/add_publisher.title_header'))

@section('main')

<section class="book_section">
    <div class="container ">
        <div class="page_info">
            <h2>{{ trans('publishers/add_publisher.btn_add') }}</h2>
        </div>
        <form method="POST" action="{{ route('publishers.store') }}">
            @csrf
            <div class="form-group edit_book">
                @if (session('create_success'))
                    <div class="alert alert-success mb-0 mt-2" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('create_success') }}
                    </div>
                @endif
                <label >{{ trans('publishers/add_publisher.name') }}</label>
                @error('name_publisher')
                    <label class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </label>
                @enderror
                <input class="form-control" type="text" name="name_publisher" id="name_publisher" placeholder="{{ trans('publishers/add_publisher.ex_name') }}">

                <label >{{ trans('publishers/add_publisher.email') }}</label>
                @error('email')
                    <label class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </label>
                @enderror
                <input class="form-control" type="text" name="email" id="email" placeholder="{{ trans('publishers/add_publisher.ex_email') }}">

                <label >{{ trans('publishers/add_publisher.address') }}</label>
                @error('address')
                    <label class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </label>
                @enderror
                <input class="form-control" type="text" name="address" placeholder="{{ trans('publishers/add_publisher.ex_address') }}" id="address">
                
                <div class="form-group edit_btn">
                    <a href="{{ route('publishers.index') }}" class="btn_book_cancel btn btn-primary">{{ trans('publishers/add_publisher.cancel') }}</a>
                    <button class="btn_book_add" type="submit" >{{ trans('publishers/add_publisher.add') }}</button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection