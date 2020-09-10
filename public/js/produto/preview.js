function preview1(input) {
    $('#images').html("");
    for (i = 0; i < input.files.length; i++) {
        var reader = new FileReader();
        reader.onload = function (e) {
            if (!$('#images figure').length) {
                $('#images').html('');
            }
            var fig = $("<figure class='col'><img src=''></figure>");
            fig.find('img').attr('src', e.target.result);
            $('#images').append(fig);
        };
        reader.readAsDataURL(input.files[i]);
    }
}