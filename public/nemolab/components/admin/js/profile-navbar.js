document.addEventListener("DOMContentLoaded", function () {
    const profileDiv = document.getElementById("profileMenu");
    const profileImg = document.getElementById("myProfile");
 
    if (profileImg && profileDiv) {
        profileImg.addEventListener("click", function () {
            profileDiv.classList.toggle("menu");
        });
        function removeMenuClassOnMobile() {
            if (window.innerWidth <= 576) {
                profileDiv.classList.remove("menu");
            }
        }
        removeMenuClassOnMobile();
 
        window.addEventListener("resize", removeMenuClassOnMobile);
    }
 });
 