@extends('backend.admin_master')
@section('admin_content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row-fluid sortable">

        <div class="box span12">
            @if (Session::get('message'))
                <div class='alert alert-success'>
                    <?php
                    $message = Session::get('message');
                    echo "$message";
                    Session::put('message', null);
                    ?>
                </div>
            @endif
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Category List</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Photo</th>
                            <th>Condition</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="center">{{ $item->title }}</td>
                                <td class="center">{{ $item->slug }}</td>
                                <td class="center">{{ strip_tags($item->description) }}</td>
                                {{-- storage/app/""/public should be change config->filesystems.php['app/public'] --}}
                                <td class="center"><img src="{{ asset('storage/' . $item->photo) }}" height="150px"
                                        width="150px"  alt="" srcset=""></td>
                                {{-- public --}}
                                {{-- <td class="center"><img src="{{asset('category/'.$item->image)}}" alt="" srcset=""></td> --}}
                                <td class="center">
                                    @if ($item->condition == 'Banner')
                                        <span class="label label-success">Banner</span>
                                    @else
                                        <span class="label label-primary">Promo</span>
                                    @endif
                                </td>
                                <td class="center">
                                    @if ($item->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Deactive</span>
                                    @endif
                                </td>
                                <td class="center">
                                    @if ($item->status == 1)
                                        <a class="btn btn-success" href="{{ url('/banners/' . $item->id) }}">
                                            <i class="halflings-icon white thumbs-down"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-danger" href="{{ url('/banners/' . $item->id) }}">
                                            <i class="halflings-icon white thumbs-up"></i>
                                        </a>
                                    @endif
                                    <a class="btn btn-info" href="{{ route('banners.edit',$item->id)}}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <form class='d-flex' action="{{ route('banners.destroy',$item->id)}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger"> <i class="halflings-icon white trash"></i></button>
                                    </form>
                                    {{-- <a class="btn btn-danger" href="#">
                                        <i class="halflings-icon white trash"></i>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!--/span-->

    </div>


@endsection