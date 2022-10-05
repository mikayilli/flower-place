<div class="tab-pane" id="timeline">
    <!-- The timeline -->
    <form action="{{ route("products.store") }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="timeline timeline-inverse">
            <!-- timeline time label -->
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Description
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
              <textarea id="summernote" name="description">
                {!! old('description') ?? $product->description !!}
              </textarea>
                </div>
            </div>
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Specification
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
              <textarea id="summernote1" name="specification">
                 {!!  old('specification') ?? $product->specification !!}
              </textarea>
                </div>
            </div>
        </div>
        <button class="btn btn-info">update</button>
    </form>
</div>
