        jQuery(document).ready(function () {
            jQuery('.buttoncam').click(function (e) {
                e.preventDefault();
                var inp = jQuery(this).siblings('input[name="_custom_product_foto"]');
                var image = wp.media({
                    title: 'Upload Image',
                    multiple: false
                }).open()
                    .on('select', function (e) {
                        var uploaded_image = image.state().get('selection').first();
                        var image_url = uploaded_image.toJSON().url;
                        inp.val(image_url);
                    });
            });
			
			jQuery('.removecam').click(function (e) {
				jQuery('input[name="_custom_product_foto"]').val("");
			});
			
			jQuery('.removeall').click(function (e) {
				jQuery('.my_options_group .clerinp').val('');
			});

        });