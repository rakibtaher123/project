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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Product</h2>

            </div>

            <div class="box-content">
                <form class="form-horizontal" action="{{ route('products.update',$product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01">Product Code</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="code" required
                                    value="{{ $product->code }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Product Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="name" required
                                    value="{{ $product->name }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Category Name</label>
                            <div class="controls">
                                <select name="cat_id" id="">selected to Category
                                    <option value="">{{ $categories->find($product->cat_id)->name }}</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="date01">Sub Category Name</label>
                            <div class="controls">
                                <select name="subcat_id" id="">selected to Sub Category
                                    <option value="">{{ $subcategories->find($product->subcat_id)->name }}</option>
                                    @foreach ($subcategories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Brand Name</label>
                            <div class="controls">
                                <select name="brand_id" id="">selected to Brand
                                    <option value="">{{ $brands->find($product->brand_id)->name }}</option>
                                    @foreach ($brands as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Unit Name</label>
                            <div class="controls">
                                <select name="unit_id" id="">selected to Unit
                                    <option value="">{{ $units->find($product->unit_id)->name }}</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Sizes</label>
                            <div class="controls">
                                <select name="size_id" id="">selected to Sizes
                                    <option value="">{{ $sizes->find($product->size_id)->size }}</option>
                                    @foreach ($sizes as $item)
                                        <option value="{{ $item->id }}">{{ $item->size }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Colors</label>
                            <div class="controls">
                                <select name="color_id" id="">selected to Colors
                                    <option value="">
                                        {{ implode(',', json_decode($colors->find($product->color_id)->color)) }}</option>
                                    @foreach ($colors as $item)
                                        <option value="{{ $item->id }}">{{ implode(',', json_decode($item->color)) }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="date01">Product Price</label>
                            <div class="controls">
                                <input type="number" class="input-xlarge" name="price" required
                                    value="{{ $product->price }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Product Discount</label>
                            <div class="controls">
                                <input type="number" class="input-xlarge" name="discount" required
                                    value="{{ $product->discount }}">
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Product Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="description" rows="3" required>{{ strip_tags($product->description) }}</textarea>
                            </div>

                        </div>

                        <div class="control-group">
                            <label class="control-label">File Upload</label>
                            <div class="controls">
                                <input type="file" name="file[]" multiple>
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Updated Product</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
    </div>
    <!--/row-->
@endsection
