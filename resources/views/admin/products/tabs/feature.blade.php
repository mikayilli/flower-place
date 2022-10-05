<div class="tab-pane" id="features">
    <form action="{{ route('products.store') }}" method="post">
        <input type="hidden" name="id" value="{{ $product->id }}">
        @csrf
        <div class="row">
            <div class="col-12 col-md-6">
                <!-- origin -->
                <div class="form-group">
                    <label>Origin</label>
                    <select class="select2 form-control" name="origin_id">
                        <option value="">---- remove ----</option>
                        @foreach($origins as $origin)
                            <option
                                value="{{ $origin->id }}" {{ isSelected('id', ($origin ?? null), $product->origin_id)  }}>{{ $origin->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Discount</label>
                    <select class="select1 form-control" name="discount_id">
                        <option value="">---- remove ----</option>
                        @foreach($discounts as $discount)
                            <option
                                value="{{ $discount->id }}" {{ isSelected('id', ($discount ?? null), $product->discount_id)  }}>{{ $discount->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Label</label>
                    <select class="select3 form-control" name="label_id[]" multiple>
                        <option value="">---- remove ----</option>

                        @foreach($labels as $label)
                            <option value="{{ $label->id }}" {{ in_array($label->id, $product->labels->pluck('id')->toArray()) ? 'selected' : null }}>{{ $label->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Color</label>
                    <select class="select3 form-control" name="color_id[]" multiple>
                        <option value="">---- remove ----</option>

                        @foreach($colors as $color)
                            <option value="{{ $color->id }}" {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'selected' : null }}>{{ $color->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-success btn-sm">Add / Update</button>
            </div>
        </div>
    </form>
</div>
