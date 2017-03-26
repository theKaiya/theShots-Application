@extends('header')

@section('title') Create a new shot. @endsection

@section('main')
    <section class="no-border-bottom">
        <div class="container">
            <header class="section-header">
                <span>Upload</span>
                <h2>Add shot</h2>
                <p>Give a title, upload an image, and write a description to create a shot.</p>
            </header>

            <form action="{{ Route('shot_create_action')  }}" class="form-horizontal1" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h6>Shot details</h6>
                            </div>

                            <div class="card-block">
                                @include('errors.errors')
                                <div class="form-group">
                                    <input name="title" type="text" class="form-control input-lg" placeholder="Title" required>
                                </div>

                                <div class="form-group">
                                    <label>Preview image</label>
                                    <input type="file" class="dropify" name="preview_image">
                                    <span class="help-block">The max image size is 1280x720 pixels</span>
                                </div>

                                <div class="form-group">
                                    <label>Images</label>
                                    <input type="file" name="images[]" multiple>
                                </div>

                                <div class="form-group">
                                    <label for="input-desc">Description</label>
                                    <textarea name="description" class="form-control" id="input-desc" rows="6" required></textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">

                        <div class="card">
                            <div class="card-header">
                                <h6>Meta data</h6>
                            </div>

                            <div class="card-block">
                                <span class="help-block">Separate tags with comma</span>
                                <div class="form-group">
                                    <textarea name="tags" class="form-control" rows="3" placeholder="Tags..."></textarea>
                                </div>


                            </div>
                        </div>
                        {{ csrf_field()  }}
                        <button class="btn btn-primary btn-block" type="submit">Submit shot</button>

                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection