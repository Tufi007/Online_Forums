(function() {
    document.getElementById("toggle-sidebar").addEventListener("click", function () {
        var sidebar = document.getElementById("sidebar");
        if (sidebar.style.width === "0px" || sidebar.style.width === "") {
            sidebar.style.width = "250px";
        } else {
            sidebar.style.width = "0";
        }
    });
})();


    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-comment-button").forEach(function (button) {
            button.addEventListener("click", function () {
                const commentId = button.getAttribute("data-comment-id");
                const form = document.getElementById("edit-form-" + commentId);

                if (form.style.display === "none" || form.style.display === "") {
                    form.style.display = "block";
                } else {
                    form.style.display = "none";
                }
            });
        });
    });


