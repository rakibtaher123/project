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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Banner</h2>

            </div>

            <div class="box-content">
                <form class="form-horizontal" action="{{ url('banners/' . $banner->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01">Title</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="title" required
                                    value="{{ $banner->title }}">
                            </div>
                        </div>

                        {{-- <div class="control-group">
                            <label class="control-label" for="date01">Slug</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="slug" required>
                            </div>
                        </div> --}}


                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="description" rows="3" required>{{ strip_tags($banner->description) }}</textarea>
                            </div>

                        </div>

                        <div class="control-group">
                            <label class="control-label">Banner Upload</label>
                            <div class="controls">
                                <input type="file" name="photo" value="{{ $banner->photo }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Condition</label>
                            <div class="controls">
                                <select name="condition" id="">selected to condition
                                    {{-- @if ($banner->condition == 'banner') --}}

                                    <option value="Banner" {{ $banner->condition == 'Banner' ? 'selected' : '' }}>Banner
                                    </option>
                                    <option value="Promo" {{ $banner->condition == 'Promo' ? 'selected' : '' }}>Promo
                                    </option>
                                    {{-- @endif --}}
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Status</label>
                            <div class="controls">
                                <select name="status" id="">selected to Status
                                    {{-- @if ($banner->status == '1') --}}
                                    <option value="1" {{ $banner->status == '1' ? 'selected' : '' }}>
                                        Active</option>
                                    {{-- @else --}}
                                    <option value="0" {{ $banner->status == '0' ? 'selected' : '' }}>Deactive</option>
                                    {{-- @endif --}}



                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Updated</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->


@endsection
