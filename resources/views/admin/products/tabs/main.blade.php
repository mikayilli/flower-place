<div class="tab-pane active" id="activity">
    <form action="{{ route('products.store') }}" method="post">
        <input type="hidden" value="{{ $product->id ?? null }}" name="id">
        @csrf
        <div class="col-12 col-md-8 offset-0 offset-md-2">
            <!-- name -->
            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input id="name" name="name" type="text" class="form-control" placeholder="name" value="{{ old('name') ?? ($product->name ?? null) }}" required>
                <span class="text-danger">@error('name') {{$message}} @enderror</span>
            </div>
            <!-- price -->
            <div class="form-group">
                <label for="price">Price <span class="text-danger">*</span></label>
                <input id="price" name="price" type="number" step="0.1" class="form-control" placeholder="price" value="{{ old('price') ?? ($product->price ?? null) }}" required>
                <span class="text-danger">@error('price') {{$message}} @enderror</span>
            </div>

            <!-- product type -->
            <div class="form-group">
                <label for="width">Product Type <span class="text-danger">*</span></label>
                <select name="type_id" id="status" @class(["is-invalid" => $errors->has('type_id'), "form-control"]) required>
                    <option value="">Select</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ isSelected('type_id', ($product ?? null), $type->id)  }} >{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- addition discount -->
            <div class="form-group">
                <label for="addition_discount">Addition Discount</label>
                <input id="addition_discount" name="addition_discount" type="number" class="form-control" placeholder="Addition Discount" value="{{ old('addition_discount') ?? ($product->addition_discount ?? null) }}">
                <span class="text-danger">@error('addition_discount') {{$message}} @enderror</span>
            </div>

            <!-- consist quantity -->
            <div class="form-group">
                <label for="consist_quantity">Consist Quantity</label>
                <input id="consist_quantity" name="consist_quantity" type="number" class="form-control" placeholder="Consist quantity" value="{{ old('consist_quantity') ?? ($product->consist_quantity ?? null) }}">
                <span class="text-danger">@error('consist_quantity') {{$message}} @enderror</span>
            </div>

            <!-- height -->
            <div class="form-group">
                <label for="height">Height <span class="text-danger">*</span></label>
                <select name="height" id="height" class="form-control"  required>
                    <option value="">---- select ---</option>
                    <option {{ isSelected('height', ($product ?? null), '40')  }}>40</option>
                    <option {{ isSelected('height', ($product ?? null), '50')  }}>50</option>
                    <option {{ isSelected('height', ($product ?? null), '60')  }}>60</option>
                    <option {{ isSelected('height', ($product ?? null), '70')  }}>70</option>
                    <option {{ isSelected('height', ($product ?? null), '80')  }}>80</option>
                    <option {{ isSelected('height', ($product ?? null), '90')  }}>90</option>
                    <option {{ isSelected('height', ($product ?? null), '100')  }}>100</option>
                </select>
                <span class="text-danger">@error('height') {{$message}} @enderror</span>
            </div>

            <!-- width -->
            <div class="form-group">
                <label for="width">Width</label>
                <input id="width" type="number"  name="width" class="form-control" placeholder="Width" value="{{ old('width') ?? ($product->width ?? null) }}">
                <span class="text-danger">@error('width') {{$message}} @enderror</span>
            </div>

            <!-- short_description -->
            <div class="form-group">
                <label for="s_d">Short Description</label>
                <input id="s_d" name="short_description" type="text" class="form-control" placeholder="short_description" value="{{ old('short_description') ?? ($product->short_description ?? null) }}">
                <span class="text-danger">@error('short_description') {{$message}} @enderror</span>
            </div>

            <!-- tags -->
            <div class="form-group">
                <label for="tags">Tags <small>(separate with comma)</small></label>
                <input id="tags" name="tags" type="text" class="form-control" placeholder="tags," value="{{ old('tags') ?? ($product->tags ?? null) }}">
                <span class="text-danger">@error('tags') {{$message}} @enderror</span>
            </div>

            <!-- status -->
            <div class="form-group">
                <label for="status">Status <span class="text-danger">*</span></label>
                <select name="status" id="status" @class(["is-invalid" => $errors->has('status'), "form-control"]) required>
                    <option {{ isSelected('status', ($product ?? null), '1')  }} value="1">Active</option>
                    <option {{ isSelected('status', ($product ?? null), '0') }} value="0">Inactive</option>
                </select>
                <span class="text-danger">@error('status') {{$message}} @enderror</span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Add / Update</button>
            </div>
        </div>
    </form>
</div>
