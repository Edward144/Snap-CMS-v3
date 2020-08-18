var templateDir = root_dir + 'admin/scripts/tinymce/templates/';
var customCss = root_dir + 'css/custom.min.css,' + root_dir + 'css/style.min.css';

function startTiny() {
    tinymce.init({
        selector:'textarea:not(.noTiny):not(.tinySlider)',
        plugins: 'paste image imagetools table code save link moxiemanager media fullscreen lists template autoresize',
        menubar: 'file edit format insert table',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table tabledelete | fontsizeselect | link insert | code fullscreen | template',
        templates: [
            {title: 'Two Column', description: 'A two column layout that will responsively update to a single column on smaller devices.', url: templateDir + 'two-column.html'},
            {title: 'Three Column', description: 'A three column layout that will responsively update to a single column on smaller devices.', url: templateDir + 'three-column.html'},
        ],
        min_height: 350,
        max_height: 1500,
        relative_urls: false,
        remove_script_host: false,
        image_title: true,
        content_css: customCss,
        extended_valid_elements: 'span, script[src|async|defer|type|charset]',
        allow_script_urls: true
    });
}

startTiny();