<div class="tab-pane" id="size">
    <form action="{{ route('products.add_size', $product) }}" method="post" >
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <!-- 1 -->
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name1">Name</label>
                    <input type="text" class="form-control" name="name_small" id="name1" placeholder="Name" value="{{ $sizes?->name_small }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name2">Price</label>
                    <input type="number" class="form-control" name="price_small" id="name2" placeholder="Price" value="{{ $sizes?->price_small }}">
                </div>
            </div>
        </div>
        <!-- 2 -->
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name1">Name</label>
                    <input type="text" class="form-control" name="name_medium" id="name1" placeholder="Name" value="{{ $sizes?->name_medium }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name2">Price</label>
                    <input type="number" class="form-control" name="price_medium" id="name2" placeholder="Price" value="{{ $sizes?->price_medium }}">
                </div>
            </div>
        </div>

        <!-- 3 -->
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name1">Name</label>
                    <input type="text" class="form-control" name="name_big" id="name1" placeholder="Name" value="{{ $sizes?->name_big }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name2">Price</label>
                    <input type="number" class="form-control" name="price_big" id="name2" placeholder="Price" value="{{ $sizes?->price_big }}">
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">Update</button>
        </div>
    </form>
</div>
