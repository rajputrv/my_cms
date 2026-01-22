function load_online_users_instantly() {
    $.get("functions.php?onlineusers=true")
        .done(function(data) {
            $(".usersonline").text(data);
        })
        .fail(function() {
            console.error("Error loading online users.");
        });
}

setInterval(load_online_users_instantly, 500);

//select all checkboxes in view posts. if topmost checkbox is checked
const selectAllBoxes = document.getElementById("selectAllBoxes");
if(selectAllBoxes){
selectAllBoxes.addEventListener("change", function() {
    const checkboxes = document.getElementsByClassName("checkBoxes");
    const isChecked = this.checked;

    Array.from(checkboxes).forEach(checkbox => {
        checkbox.checked = isChecked;
    });
});
}

var div_box = "<div id='load-screen'><div id='loading'></div></div>";
document.body.insertAdjacentHTML('afterbegin', div_box);

var loadscreen = document.getElementById("load-screen");
setTimeout(function() {
    $(loadscreen).fadeOut(600, function() {
        this.remove();
    });
}, 700);




// using tinumce WYSIWYG editor for textarea in all pages
  tinymce.init({
    selector: 'textarea',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Jan 29, 2026:
      'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'ai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    uploadcare_public_key: '8e065dd1d934f0de64b3',
  });



