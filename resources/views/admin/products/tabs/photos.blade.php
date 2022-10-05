<div class="tab-pane" id="photo">
    <div class="col-12 mb-5">
        <form action="{{ route("products.store") }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $product->id }}" name="id">
            <div class="form-group">
                <label for="name">Chose Main Photo <span class="text-danger">*</span></label>
                <input type="file" name="photo" required>
            </div>

            <img src="{{url('storage/products/thumb_' .$product->image)}}" alt="" class="img-fluid img-bordered-sm">
            <button class="btn btn-success btn-xs d-block mt-3">Submit Main Photo</button>
        </form>
    </div>
    <div class="col-12">
        <form action="{{ route("products.store") }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $product->id }}" name="id">
            <p class="zad">
                <div class="form-group">
                    <label for="name">Chose Gallery Photo <span class="text-danger">*</span></label>
                    <input type="file" data-rank="{{ $defaultRank }}" name="gallery[{{$defaultRank}}]"
                           class="xxa {{$defaultRank}}" onchange="previewFile();">
                </div>
            </p>
            <div id="box">
                <div class="row" id="sortable">
                    @foreach($gallery as $gal)
                        <div class="gallery-photo col-12 col-md-3 db">
                            <i class="remove from-table-remove far fa-times-circle"
                                  data-id="{{ $gal->id }}"  title="Delete"></i>
                            <img data-id="{{ $gal->id }}" data-rank="{{ $gal->rank }}"
                                 src="{{ url("storage/products/gallery/". $gal->photo) }}" alt="" class="img-fluid img-bordered-sm">
                        </div>
                    @endforeach
                </div>
            </div>
            <p>
                <input type="submit" value="Submit Gallery" class="btn btn-xs btn-success mt-3">
            </p>
        </form>
    </div>
</div>


