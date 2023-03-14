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
                <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
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
                            <th>Order Id</th>
                            <th>Customer Name</th>
                            <th>Order Total</th>
                            <th>Order Date and Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="center">{{ $customr->find($item->cus_id)->name }}</td>
                                <td class="center">{{ $item->total }}</td>
                                <td class="center">{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y ,h:iA') }}
                                </td>
                                <td class="center">
                                    @if ($item->status == 'success')
                                        <span class="label label-success">{{ $item->status }}</span>
                                    @else
                                        <span class="label label-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="center d-flex">
                                    @if ($item->status == 'success')
                                        <a class="btn btn-success" href="{{ url('manage-order/' . $item->id) }}">
                                            <i class="halflings-icon white thumbs-up"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-danger" href="{{ url('manage-order/' . $item->id) }}">
                                            <i class="halflings-icon white thumbs-down"></i>
                                        </a>
                                    @endif
                                    <a class="btn btn-info" href="{{ url('view-order/' . $item->id) }}">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <form action="{{ route('manage-order.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"> <i
                                                class="halflings-icon white trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->


@endsection
