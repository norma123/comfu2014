
<div class="tab-content">
	<p class="alert alert-info">Add / Edit Banners<br/>Banner width:820px<br/>Banner height:294px</p>
	  <form id="fileupload" action="<? echo base_url() . 'admin/banners/upload_img'; ?>" method="POST" enctype="multipart/form-data">
			<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
			<div class="row fileupload-buttonbar">
				<div class="span7">
					<!-- The fileinput-button span is used to style the file input field as button -->
					<span class="btn btn-success fileinput-button">
						<i class="icon-plus icon-white"></i>
						<span>Add Banners...</span>
						<input type="file" name="userfile" multiple>
					</span>
					<button type="submit" class="btn btn-primary start">
						<i class="icon-upload icon-white"></i>
						<span>Start upload</span>
					</button>
					<button type="reset" class="btn btn-warning cancel">
						<i class="icon-ban-circle icon-white"></i>
						<span>Cancel upload</span>
					</button>
					<button type="button" class="btn btn-danger delete">
						<i class="icon-trash icon-white"></i>
						<span>Delete</span>
					</button>
					<input type="checkbox" class="toggle">
				</div>
				<!-- The global progress information -->
				<div class="span5 fileupload-progress fade">
					<!-- The global progress bar -->
					<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
						<div class="bar" style="width:0%;"></div>
					</div>
					<!-- The extended global progress information -->
					<div class="progress-extended">&nbsp;</div>
				</div>
			</div>
			<!-- The loading indicator is shown during file processing -->
			<div class="fileupload-loading"></div>
			<br>
			<!-- The table listing the files available for upload/download -->
			<table role="presentation" class="table table-striped">
				<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
				</tbody>
			</table>
		</form>
		<br>
	<!-- modal-gallery is the modal dialog used for the image gallery -->
	<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3 class="modal-title"></h3>
		</div>
		<div class="modal-body"><div class="modal-image"></div></div>
		<div class="modal-footer">
			<a class="btn modal-download" target="_blank">
				<i class="icon-download"></i>
				<span>Download</span>
			</a>
			<a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
				<i class="icon-play icon-white"></i>
				<span>Slideshow</span>
			</a>
			<a class="btn btn-info modal-prev">
				<i class="icon-arrow-left icon-white"></i>
				<span>Previous</span>
			</a>
			<a class="btn btn-primary modal-next">
				<span>Next</span>
				<i class="icon-arrow-right icon-white"></i>
			</a>
		</div>
	</div>
	<!-- The template to display files available for upload -->
	<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-upload fade">
			<td class="preview"><span class="fade"></span></td>
			<td class="name"><span>{%=file.name%}</span></td>
			<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
			{% if (file.error) { %}
				<td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
			{% } else if (o.files.valid && !i) { %}
				<td>
					<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
				</td>
				<td>{% if (!o.options.autoUpload) { %}
					<button class="btn btn-primary start">
						<i class="icon-upload icon-white"></i>
						<span>Start</span>
					</button>
				{% } %}</td>
			{% } else { %}
				<td colspan="2"></td>
			{% } %}
			<td>{% if (!i) { %}
				<button class="btn btn-warning cancel">
					<i class="icon-ban-circle icon-white"></i>
					<span>Cancel</span>
				</button>
			{% } %}</td>
		</tr>
	{% } %}
	</script>
	<!-- The template to display files available for download -->
	<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-download fade">
			{% if (file.error) { %}
				<td></td>
				<td class="name"><span>{%=file.name%}</span></td>
				<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
				<td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
			{% } else { %}
				<td class="preview">{% if (file.thumbnail_url) { %}
					<a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
				{% } %}</td>
				<td class="name">
					<a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
				</td>
				<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
				<td colspan="2"></td>
			{% } %}
			<td>
				<button class="btn btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
					<i class="icon-trash icon-white"></i>
					<span>Delete</span>
				</button>
				<input type="checkbox" name="delete" value="1" class="toggle">
			</td>
		</tr>
	{% } %}
	</script>
	  </div>
 
</div>



<script>
$(function() {
	$('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
});
</script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo site_url('assets/js/vendor/jquery.ui.widget.js')?>"></script>
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo site_url('assets/js/jquery.iframe-transport.js')?>"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo site_url('assets/js/jquery.fileupload.js')?>"></script>
<!-- The File Upload file processing plugin -->
<script src="<?php echo site_url('assets/js/jquery.fileupload-fp.js')?>"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo site_url('assets/js/jquery.fileupload-ui.js')?>"></script>
<!-- The main application script -->
<!-- <script src="<?php echo site_url('assets/js/main.js')?>"></script>-->
<script>
/*
 * jQuery File Upload Plugin JS Example 7.1.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload();

    // Enable iframe cross-domain access via redirect option:
   // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            './cors/result.html?%s'
            )
        );
            
           $('#download-files > .template-download > .add').each(function(e){
                             

                                alert(e);

                                

                                });

    if (window.location.hostname === 'localhost') {
              // Upload server status check for browsers with CORS support:
        if ($.ajaxSettings.xhr().withCredentials !== undefined) {
			 
			$('#fileupload').fileupload('option', {
            url: '<?echo base_url()?>admin/banners/upload_img/',
            maxFileSize: 500000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            process: [
                {
                    action: 'load',
                    fileTypes: /^image\/(gif|jpeg|png)$/,
                    maxFileSize: 200000 // 20MB
                },
                {
                    action: 'resize',
                    maxWidth: 1440,
                    maxHeight: 900
                },
                {
                    action: 'save'
                }
            ]
        });
             $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: "<?echo base_url()?>admin/banners/get_files",
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function (result) {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done').call(this, null, {result: result});
			$(".imgnbr").html($(".template-download").length);
        });
        }
    } else {
		
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: "<?echo base_url()?>admin/banners/get_files",
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function (result) {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done').call(this, null, {result: result});
        });
    }

});

</script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="assets/js/cors/jquery.xdr-transport.js"></script><![endif]-->