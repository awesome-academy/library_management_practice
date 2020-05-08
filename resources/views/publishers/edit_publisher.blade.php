@extends('master')

@section('title_header', trans('publishers/edit_publisher.title_header'))

@section('main')

<section class="book_section">
    <div class="container ">
        <div class="page_info">
            <h2>{{ trans('publishers/edit_publisher.btn_edit') }}</h2>
        </div>
        <form method="POST" action="{{ route('publishers.update', ['publisher' => $publisher->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group edit_book">
                @if (session('update_success'))
                    <div class="alert alert-success mb-0 mt-2" role="alert">
                        {{ session('update_success') }}
                    </div>
                @endif
                <label >{{ trans('publishers/edit_publisher.name') }}</label>
                <input class="form-control" name="name_publisher" id="name_publisher" value="{{ $publisher->name_publisher }}" >

                <label >{{ trans('publishers/edit_publisher.email') }}</label>
                <input class="form-control" name="email" id="email" value="{{ $publisher->email }}">

                <label >{{ trans('publishers/edit_publisher.address') }}</label>
                <input class="form-control" name="address" id="address" value="{{ $publisher->address }}">

                <div class="form-group edit_btn">
                    <a class="btn_book_cancel" href="{{ route('publishers.index') }}" type="submit">{{ trans('publishers/edit_publisher.cancel') }}</a>
                    <button class="btn_book_add" type="submit">{{ trans('publishers/edit_publisher.edit') }}</button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection