@extends('master')

@section('title_header', trans('publishers/publisher.title_header'))

@section('main')

<section class="group_section">
    <div class="container list_author">
        @if (session('delete_success'))
            <div class="alert alert-success mb-0 mt-2" role="alert">
                {{ session('delete_success') }}
            </div>
        @endif
        <div class="row">

            <div class="col-9">
                <a href="{{ route('publishers.create') }}"><button class="btn_new">{{ trans('publishers/publisher.add_new') }}</button></a>
            </div>
            <div class="col-3">
                <div class="search-publisher">
                    <form class="search_widget" action="{{ url('publishers') }}" method="GET">
                        <input type="hidden" name="action" value="search">
                        <input type="text" name="key" id="input" class="form-control" value="" placeholder="{{ trans('publishers/publisher.search') }}">
                        <button type="submit">{{ trans('publishers/publisher.search') }}</button>
                    </form>
                </div>
            </div>
        </div>
            <table class="table table-striped text_table cent_table">
            <thead>
                <tr>
                    <th scope="col">{{ trans('publishers/publisher.id') }}</th>
                    <th scope="col">{{ trans('publishers/publisher.name') }}</th>
                    <th scope="col">{{ trans('publishers/publisher.email') }}</th>
                    <th scope="col">{{ trans('publishers/publisher.address') }}</th>
                    <th class="width_t" scope="col">{{ trans('publishers/publisher.option') }}</th>
                </tr>
            </thead>
            <?php $i=1 ?>
            @foreach( $publisher as $data_publisher )
            <tbody>
                <tr>
                    <td scope="row"><?php echo $i++ ;?></td>
                    <td scope="row">{{ $data_publisher->name_publisher}}</td>
                    <td scope="row">{{ $data_publisher->email}}</td>
                    <td scope="row">{{ $data_publisher->address}}</td>
                    <td>
                        <a class="btn_edit edit_user" title="Edit" type="submit" value="Edit" href="{{ route('publishers.edit',$data_publisher->id) }}">{{ trans('publishers/publisher.edit') }}</a>
                        <form action="{{ route('publishers.destroy',$data_publisher->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="btn_delete delete_user" title="Delete" type="submit" value="Delete">{{ trans('publishers/publisher.delete') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $publisher->links() }}
    </div>
</section>
    
@endsection