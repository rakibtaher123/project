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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Banner</h2>

            </div>

            <div class="box-content">
                <form class="form-horizontal" action="{{ url('/banners/') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01">Title</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="title" required>
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
                                <textarea class="cleditor" name="description" rows="3" required></textarea>
                            </div>

                        </div>

                        <div class="control-group">
                            <label class="control-label">Banner Upload</label>
                            <div class="controls">
                                <input type="file" name="photo">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Condition</label>
                            <div class="controls">
                                <select name="condition" id="">selected to condition
                                    <option value="Banner" {{ old('condition') == 'Banner' ? 'selected' : '' }}>Banner
                                    </option>
                                    <option value="Promo" {{ old('condition') == 'Promo' ? 'selected' : '' }}>Promo
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Status</label>
                            <div class="controls">
                                <select name="status" id="">selected to Status
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Banner</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->




@endsection
