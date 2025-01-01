var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    // CKEDITOR.config.height = 250;
    function Ckeditor($id, $height){
        CKEDITOR.replace($id, options);
        CKEDITOR.config.height = $height;
    };
    // CKEDITOR.replace('description', options);
 
    CKEDITOR.config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
    CKEDITOR.config.colorButton_enableMore = true;
    CKEDITOR.config.floatpanel = true;
    CKEDITOR.config.floatpanel = true;
    CKEDITOR.config.removeButtons = 'Save,NewPage,Preview,Print,Templates,PasteFromWord,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,PageBreak,ShowBlocks,About';
