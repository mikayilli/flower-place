<div class="tab-pane" id="settings">
    <form action="{{ route('products.store') }}" method="post">
        @csrf
        <input type="hidden" value="{{ $product->id }}" name="id">
        <div class="form-group">
            <label for="exampleInputName2">Meta tag Title</label>
            <input type="text"
                   @class(["is-invalid" => $errors->has('meta_tag_title'), "form-control" => true]) name="meta_tag_title"
                   id="exampleInputName2" placeholder="Meta tag Title"
                   value="{{ old('meta_tag_title') ?? ($product->meta_tag_title ?? '') }}">
            <span class="text-danger">@error('meta_tag_title') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="exampleInputName3">Meta tag description</label>
            <textarea rows="3" name="meta_tag_description"
                      @class(["is-invalid" => $errors->has('meta_tag_description'), "form-control" => true]) id="exampleInputName3"
                      placeholder="Meta tag description">{{ old('meta_tag_description') ?? ($product->meta_tag_description ?? '') }}
                                    </textarea>
            <span
                class="text-danger">@error('meta_tag_description') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="exampleInputName4">Meta tag keywords</label>
            <textarea rows="3" name="meta_tag_keywords"
                      @class(["is-invalid" => $errors->has('meta_tag_keywords'), "form-control" => true]) id="exampleInputName4"
                      placeholder="Meta tag keywords">{{ old('meta_tag_keywords') ?? ($product->meta_tag_keywords ?? '') }}
                                    </textarea>
            <span class="text-danger">@error('meta_tag_keywords') {{$message}} @enderror</span>
        </div>
        <button class="btn btn-success btn-sm">Add / Update</button>
    </form>
</div>
