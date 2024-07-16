tinymce.init({
    selector:'.textareaEditor',

    language_url: 'public/js/tinymce-fr_FR.js',
    language: 'fr_FR',
    browser_spellcheck: true,
    contextmenu: false,

    plugins: 'wordcount',

    menubar: 'edit format tools',
    menu: {
        format: { title: 'Format', items: 'bold italic underline | fontsize align | forecolor | language | removeformat' },
        tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | wordcount' },
    },
    toolbar: 'bold | italic | underline | alignleft | aligncenter | alignright | alignjustify | forecolor | wordcount',
});

tinymce.init({
    selector:'.textareaEditorBoldAndItalic',

    language_url: 'public/js/tinymce-fr_FR.js',
    language: 'fr_FR',
    browser_spellcheck: true,
    contextmenu: false,

    plugins: 'wordcount',

    menubar: false,
    toolbar: 'bold | italic | wordcount',
    height: 200,
});

