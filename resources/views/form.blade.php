<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body { background-color: #f8f9fa; padding: 40px 0; }
        .card { box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: none; border-radius: 12px; }
        .card-header { background-color: #4f46e5; color: white; border-radius: 12px 12px 0 0 !important; }
        .select2-container .select2-selection--multiple { min-height: 38px; border: 1px solid #dee2e6; }
        .image-row { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .image-row .input-group { flex: 1; margin-bottom: 0 !important; }
        .img-preview-thumb {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #4f46e5;
            box-shadow: 0 2px 8px rgba(79,70,229,0.15);
            flex-shrink: 0;
            background: #f1f5f9;
            transition: transform 0.2s;
        }
        .img-preview-thumb:hover { transform: scale(1.08); cursor: zoom-in; }
        .img-preview-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            border: 2px dashed #cbd5e1;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 22px;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header text-center py-3">
                    <h4 class="mb-0">Evaluation Form</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('form.store') }}" method="POST" id="evaluationForm" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="languages" class="form-label">Languages Known <span class="text-danger">*</span></label>
                            <select class="form-control select2 @error('languages') is-invalid @enderror" id="languages" name="languages[]" multiple="multiple" required>
                                @foreach($languages as $language)
                                    <option value="{{ $language->name }}" {{ in_array($language->name, old('languages', [])) ? 'selected' : '' }}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">You can type to add a new language.</small>
                            @error('languages') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Add a description...">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Issue List (Optional)</label>
                            <div id="issuesContainer">
                                @if(old('issues'))
                                    @foreach(old('issues') as $index => $issue)
                                        <div class="input-group mb-2 issue-row">
                                            <input type="text" name="issues[]" class="form-control @error('issues.'.$index) is-invalid @enderror" placeholder="Enter an issue" value="{{ $issue }}">
                                            @if($index > 0)
                                                <button class="btn btn-outline-danger remove-issue-btn" type="button">Remove</button>
                                            @else
                                                <button class="btn btn-outline-danger remove-issue-btn" type="button" style="display:none;">Remove</button>
                                            @endif
                                            @error('issues.'.$index) <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2 issue-row">
                                        <input type="text" name="issues[]" class="form-control" placeholder="Enter an issue">
                                        <button class="btn btn-outline-danger remove-issue-btn" type="button" style="display:none;">Remove</button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-secondary btn-sm mt-1" id="addIssueBtn">+ Add Another Issue</button>
                            @error('issues') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <button type="button" id="showImageBtn" class="btn btn-outline-primary btn-sm mb-2">+ Add Images</button>
                            
                            <div id="imageUploadContainer" style="display: none;">
                                <label class="form-label">Upload Images (Optional, max 5)</label>
                                <div id="imageInputs">
                                    <div class="image-row">
                                        <div class="input-group">
                                            <input class="form-control image-file-input @error('images.*') is-invalid @enderror @error('images') is-invalid @enderror" type="file" name="images[]" accept=".jpg,.jpeg,.png,.gif,.webp">
                                        </div>
                                        <div class="img-preview-placeholder">🖼️</div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm mt-1" id="addMoreImagesBtn">+ Add Another Image</button>
                                <small class="text-muted d-block mt-2">Format: JPG, JPEG, PNG, GIF, WEBP. Max 5 images, up to 5MB each.</small>
                                @error('images') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                @error('images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="marks_obtained" class="form-label">Marks Obtained</label>
                                <input type="number" step="0.1" class="form-control @error('marks_obtained') is-invalid @enderror" id="marks_obtained" name="marks_obtained" value="{{ old('marks_obtained') }}" min="0" required>
                                @error('marks_obtained') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="max_marks" class="form-label">Maximum Marks</label>
                                <input type="number" step="0.1" class="form-control @error('max_marks') is-invalid @enderror" id="max_marks" name="max_marks" value="{{ old('max_marks', 10) }}" min="1" required>
                                @error('max_marks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                            <button type="button" class="btn btn-secondary w-100" id="resetBtn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 with tagging support
        $('.select2').select2({
            tags: true,
            placeholder: "Select or add languages",
            tokenSeparators: [',']
        });

        // Initialize TinyMCE for description
        tinymce.init({
            selector: '#description',
            height: 300,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });

        // Toggle Image Input
        $('#showImageBtn').click(function() {
            $('#imageUploadContainer').slideToggle();
            if($(this).text() === '+ Add Images') {
                $(this).text('- Hide Images');
            } else {
                $(this).text('+ Add Images');
                // Optional: reset inputs when hidden
            }
        });

        // Live image preview
        $(document).on('change', '.image-file-input', function() {
            const file = this.files[0];
            const row = $(this).closest('.image-row');
            const preview = row.find('.img-preview-thumb, .img-preview-placeholder');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (preview.is('img')) {
                        preview.attr('src', e.target.result);
                    } else {
                        // Replace placeholder with actual img
                        preview.replaceWith(`<img class="img-preview-thumb" src="${e.target.result}" alt="Preview" title="${file.name}">`);
                    }
                };
                reader.readAsDataURL(file);
            } else {
                // No file: restore placeholder
                if (preview.is('img')) {
                    preview.replaceWith('<div class="img-preview-placeholder">🖼️</div>');
                }
            }
        });

        // Add More Images
        $('#addMoreImagesBtn').click(function() {
            if ($('#imageInputs .image-row').length < 5) {
                $('#imageInputs').append(`
                    <div class="image-row">
                        <div class="input-group">
                            <input class="form-control image-file-input" type="file" name="images[]" accept=".jpg,.jpeg,.png,.gif,.webp">
                            <button class="btn btn-outline-danger remove-image-btn" type="button">Remove</button>
                        </div>
                        <div class="img-preview-placeholder">🖼️</div>
                    </div>
                `);
            } else {
                alert('You can only upload a maximum of 5 images.');
            }
        });

        // Remove Image Row
        $(document).on('click', '.remove-image-btn', function() {
            $(this).closest('.image-row').remove();
        });

        // Add More Issues
        $('#addIssueBtn').click(function() {
            $('#issuesContainer').append(`
                <div class="input-group mb-2 issue-row">
                    <input type="text" name="issues[]" class="form-control" placeholder="Enter an issue">
                    <button class="btn btn-outline-danger remove-issue-btn" type="button">Remove</button>
                </div>
            `);
            updateIssueRemoveButtons();
        });

        // Remove Issue Row
        $(document).on('click', '.remove-issue-btn', function() {
            $(this).closest('.issue-row').remove();
            updateIssueRemoveButtons();
        });

        function updateIssueRemoveButtons() {
            if ($('.issue-row').length > 1) {
                $('.issue-row .remove-issue-btn').show();
            } else {
                $('.issue-row .remove-issue-btn').hide();
            }
        }
        
        // Initial call for issue buttons
        updateIssueRemoveButtons();
        
        // Handle Reset Button
        $('#resetBtn').click(function() {
            // Reset form
            $('#evaluationForm')[0].reset();
            
            // Clear Select2
            $('.select2').val(null).trigger('change');
            
            // Reset max_marks to default
            $('#max_marks').val(10);
            
            // Remove validation classes
            $('.is-invalid').removeClass('is-invalid');

            // Reset TinyMCE editor
            if (typeof tinymce !== 'undefined' && tinymce.get('description')) {
                tinymce.get('description').setContent('');
            }
        });
    });
</script>
</body>
</html>
