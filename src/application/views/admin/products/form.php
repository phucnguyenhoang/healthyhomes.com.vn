<?php
$isEdit      = !empty($product['id']);
$uploadUrl   = base_url('admin/products/upload-image');
$deleteImgUrl = base_url('admin/products/delete-image/');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0">
        <i class="fas fa-<?php echo $isEdit ? 'edit' : 'plus-circle'; ?> mr-2 text-secondary"></i>
        <?php echo $isEdit ? 'Edit Product' : 'New Product'; ?>
    </h2>
    <a href="<?php echo base_url('admin/products'); ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Back to list
    </a>
</div>

<?php if (!empty($error)): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <i class="fas fa-exclamation-triangle mr-1"></i> <?php echo htmlspecialchars($error); ?>
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data"
      action="<?php echo base_url($isEdit ? 'admin/products/edit/' . $product['id'] : 'admin/products/create'); ?>">

<div class="row">

    <!-- Main column -->
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label class="font-weight-bold">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control"
                           value="<?php echo htmlspecialchars($product['name'] ?? ''); ?>"
                           placeholder="Product name" required>
                </div>
                <div class="form-group mb-0">
                    <label class="font-weight-bold">Price (VNĐ)</label>
                    <div class="input-group">
                        <input type="text" name="price" id="priceInput" class="form-control"
                               value="<?php echo number_format((int)($product['price'] ?? 0), 0, ',', '.'); ?>"
                               placeholder="0">
                        <div class="input-group-append">
                            <span class="input-group-text">đ</span>
                        </div>
                    </div>
                    <small class="text-muted">Enter number only, e.g. 15000000</small>
                </div>
            </div>
        </div>

        <!-- Description (Summernote) -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-align-left mr-1 text-secondary"></i> Description
            </div>
            <div class="card-body">
                <textarea id="description" name="description"><?php echo $product['description'] ?? ''; ?></textarea>
            </div>
        </div>

        <!-- Images -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-images mr-1 text-secondary"></i> Product Images
            </div>
            <div class="card-body">
                <!-- Existing images (edit mode) -->
                <?php if ($isEdit && !empty($product['images'])): ?>
                <p class="small text-muted mb-2">Existing images — click <i class="fas fa-times text-danger"></i> to remove.</p>
                <div class="row mb-3" id="existingImagesGrid">
                    <?php foreach ($product['images'] as $img): ?>
                    <div class="col-4 col-md-3 mb-3 img-preview-item" id="existing_<?php echo $img['id']; ?>">
                        <div class="position-relative">
                            <img src="<?php echo $img['image_url']; ?>"
                                 class="img-fluid rounded" style="height:100px;object-fit:cover;width:100%;" alt="">
                            <button type="button"
                                    class="btn btn-danger btn-sm position-absolute"
                                    style="top:4px;right:4px;padding:2px 7px;"
                                    onclick="deleteExistingImage(this, <?php echo $img['id']; ?>)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <?php endif; ?>

                <!-- New image upload drop zone -->
                <div id="imageDropZone"
                     class="border-2 rounded text-center py-4 mb-3"
                     style="border: 2px dashed #ced4da; cursor:pointer; transition: background .2s;">
                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                    <p class="mb-1 text-muted">Drag &amp; drop images here, or</p>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="addImageBtn">
                        <i class="fas fa-folder-open mr-1"></i> Browse files
                    </button>
                    <input type="file" id="imageFileInput" accept="image/*" multiple class="d-none">
                    <p class="small text-muted mt-2 mb-0">JPG, PNG, GIF, WEBP — images wider than 1024px will be resized.</p>
                </div>

                <!-- New image previews -->
                <div class="row" id="newImagesGrid"></div>

                <!-- Upload progress indicator -->
                <div id="uploadStatus" class="d-none">
                    <div class="progress" style="height:4px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark w-100"></div>
                    </div>
                    <small class="text-muted">Uploading...</small>
                </div>
            </div>
        </div>

    </div>

    <!-- Sidebar column -->
    <div class="col-lg-4">

        <!-- Publish -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-toggle-on mr-1 text-secondary"></i> Publish
            </div>
            <div class="card-body">
                <div class="custom-control custom-radio mb-2">
                    <input type="radio" id="statusDraft" name="status" value="0" class="custom-control-input"
                           <?php echo (($product['status'] ?? 0) == 0) ? 'checked' : ''; ?>>
                    <label class="custom-control-label" for="statusDraft">
                        <span class="badge badge-warning text-dark">Draft</span>
                        <small class="text-muted d-block">Not visible to public</small>
                    </label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="statusPublish" name="status" value="1" class="custom-control-input"
                           <?php echo (($product['status'] ?? 0) == 1) ? 'checked' : ''; ?>>
                    <label class="custom-control-label" for="statusPublish">
                        <span class="badge badge-success">Published</span>
                        <small class="text-muted d-block">Visible at /san-pham-khac</small>
                    </label>
                </div>
            </div>
            <div class="card-footer bg-white text-right">
                <button type="submit" class="btn btn-dark btn-sm px-4">
                    <i class="fas fa-save mr-1"></i> <?php echo $isEdit ? 'Update' : 'Save'; ?>
                </button>
            </div>
        </div>

        <!-- Display order -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-sort-numeric-up mr-1 text-secondary"></i> Display Order
            </div>
            <div class="card-body">
                <input type="number" name="display_order" class="form-control"
                       value="<?php echo (int)($product['display_order'] ?? 0); ?>"
                       min="0" max="9999">
                <small class="text-muted">Lower number appears first.</small>
            </div>
        </div>

        <!-- SEO -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white font-weight-bold">
                <i class="fas fa-search mr-1 text-secondary"></i> SEO
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="small font-weight-bold">SEO Keywords</label>
                    <input type="text" name="seo_keywords" class="form-control form-control-sm"
                           value="<?php echo htmlspecialchars($product['seo_keywords'] ?? ''); ?>"
                           placeholder="keyword1, keyword2">
                </div>
                <div class="form-group mb-0">
                    <label class="small font-weight-bold">Meta Description</label>
                    <textarea name="meta_description" class="form-control form-control-sm" rows="3"
                              maxlength="300"
                              placeholder="Meta description (max 300 chars)"><?php echo htmlspecialchars($product['meta_description'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

    </div>
</div>
</form>

<script>
var uploadUrl    = '<?php echo $uploadUrl; ?>';
var deleteImgUrl = '<?php echo $deleteImgUrl; ?>';
var pendingUploads = 0;

$(document).ready(function () {
    // Summernote
    $('#description').summernote({
        height: 350,
        placeholder: 'Describe the product...',
        toolbar: [
            ['style',  ['style']],
            ['font',   ['bold','italic','underline','clear']],
            ['para',   ['ul','ol','paragraph']],
            ['insert', ['link','picture','hr']],
            ['table',  ['table']],
            ['view',   ['fullscreen','codeview']]
        ]
    });

    // Price: allow only digits, format with dots on blur
    $('#priceInput').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    }).on('blur', function () {
        var n = parseInt(this.value.replace(/\./g, '')) || 0;
        this.value = n.toLocaleString('vi-VN');
    }).on('focus', function () {
        this.value = this.value.replace(/\./g, '');
    });

    // Drop zone hover
    var dz = document.getElementById('imageDropZone');
    dz.addEventListener('dragover', function (e) {
        e.preventDefault();
        $(this).css('background', '#f0f0f0');
    });
    dz.addEventListener('dragleave', function () {
        $(this).css('background', '');
    });
    dz.addEventListener('drop', function (e) {
        e.preventDefault();
        $(this).css('background', '');
        $.each(e.dataTransfer.files, function (i, f) { uploadImage(f); });
    });

    // Browse button
    $('#addImageBtn').on('click', function () { $('#imageFileInput').trigger('click'); });
    $('#imageFileInput').on('change', function () {
        $.each(this.files, function (i, f) { uploadImage(f); });
        $(this).val('');
    });
});

function uploadImage(file) {
    var fd = new FormData();
    fd.append('file', file);

    var tmpId = 'tmp_' + Date.now() + '_' + Math.random().toString(36).substr(2, 5);
    var placeholder = $('<div class="col-4 col-md-3 mb-3 img-preview-item" id="' + tmpId + '">' +
        '<div class="border rounded d-flex align-items-center justify-content-center bg-light" style="height:100px;">' +
        '<i class="fas fa-spinner fa-spin text-secondary"></i></div></div>');
    $('#newImagesGrid').append(placeholder);

    pendingUploads++;
    $('#uploadStatus').removeClass('d-none');

    $.ajax({
        url: uploadUrl, type: 'POST', data: fd, contentType: false, processData: false,
        success: function (res) {
            var r = typeof res === 'string' ? JSON.parse(res) : res;
            if (r.success) {
                $('#' + tmpId).replaceWith(buildNewImagePreview(r.url));
            } else {
                $('#' + tmpId).remove();
                alert('Upload failed: ' + (r.message || ''));
            }
        },
        error: function () {
            $('#' + tmpId).remove();
            alert('Upload failed.');
        },
        complete: function () {
            if (--pendingUploads <= 0) $('#uploadStatus').addClass('d-none');
        }
    });
}

function buildNewImagePreview(url) {
    return '<div class="col-4 col-md-3 mb-3 img-preview-item">' +
        '<div class="position-relative">' +
        '<img src="' + url + '" class="img-fluid rounded" style="height:100px;object-fit:cover;width:100%;" alt="">' +
        '<button type="button" class="btn btn-danger btn-sm position-absolute" ' +
        'style="top:4px;right:4px;padding:2px 7px;" onclick="$(this).closest(\'.img-preview-item\').remove()">' +
        '<i class="fas fa-times"></i></button>' +
        '<input type="hidden" name="image_urls[]" value="' + url + '">' +
        '</div></div>';
}

function deleteExistingImage(btn, imageId) {
    if (!confirm('Remove this image?')) return;
    $.ajax({
        url: deleteImgUrl + imageId, type: 'GET',
        success: function (res) {
            var r = typeof res === 'string' ? JSON.parse(res) : res;
            if (r.success) $('#existing_' + imageId).remove();
        }
    });
}
</script>
