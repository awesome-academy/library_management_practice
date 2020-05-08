@extends('master')

@section('title_header', trans('users/user.title_header'))

@section('main')

<section class="book_section">
    <div class="container-fluid list_book">
        <div class="row">
            <div class="col-9">
                <a type="button" class="btn_new" href="{{ route('users.create') }}">{{ trans('users/user.add_new') }}</a>
            </div>
            <div class="col-3">
                <div class="search-user">
                    <form class="search_widget" action="{{ url('users') }}" method="GET">
                        <input type="hidden" name="action" value="search">
                        <input type="text" name="key" id="input" class="form-control" value="" placeholder="{{ trans('users/user.search_user') }}">
                        <button type="submit"> {{ trans('users/user.search') }} </button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped text_table">
            <thead>
                <tr>
                    <th scope="col">{{ trans('users/user.id') }}</th>
                    <th scope="col">{{ trans('users/user.name') }}</th>
                    <th scope="col">{{ trans('users/user.birth') }}</th>
                    <th scope="col">{{ trans('users/user.gender') }}</th>
                    <th scope="col">{{ trans('users/user.phone') }}</th>
                    <th scope="col">{{ trans('users/user.email') }}</th>
                    <th scope="col">{{ trans('users/user.address') }}</th>
                    <th scope="col">{{ trans('users/user.role') }}</th>
                    <th class="width_t" scope="col">{{ trans('users/user.option') }}</th>
                </tr>
            </thead>
            @php($i = 1)
            @foreach($users as $data_user)
            <tbody> 
                <tr>
                    <td scope="row"><?php echo $i++; ?></td>
                    <td scope="row">{{ $data_user->name }}</td>
                    <td scope="row">{{ $data_user->birth }}</td>
                    <td scope="row">{{ $data_user->gender }}</td>
                    <td scope="row">{{ $data_user->phone }}</td>
                    <td scope="row">{{ $data_user->email }}</td>
                    <td scope="row">{{ $data_user->address }}</td>
                    <td scope="row">{{ $data_user->role }}</td>
                    <td>
                        <a href="{{ url('users/'.$data_user->id.'/edit')}}" class="btn_edit edit_user" title="Edit" type="submit" value="Edit">{{ trans('users/user.edit') }}</a>

                        <form action="{{ url("users/$data_user->id") }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="btn_delete delete_user" onclick="return confirm('Are you sure ???');" title="Delete" type="submit" value="Delete">{{ trans('users/user.delete') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
    
@endsection