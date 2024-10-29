function elementFollowScroll(object, sectionContainer, topMargin, stopOn = false, maxHeight) {
    $(window).on("scroll", function () {
        if ($(window).width() > 962) {
            let originalY = sectionContainer.offset().top;
            let scrollTop = $(window).scrollTop();
            let sidebarHeight = object.outerHeight(true);
            let stopPoint = maxHeight - sidebarHeight - topMargin;

            if (stopOn === false) {
                let newTop = scrollTop < originalY ? 0 : scrollTop - originalY + topMargin;
                if (scrollTop + sidebarHeight + topMargin >= maxHeight) {
                    object.stop(false, false).animate({ top: stopPoint - originalY }, 50);
                } else {
                    object.stop(false, false).animate({ top: newTop }, 50);
                }
            } else {
                let newTop = scrollTop < originalY ? 0 : Math.min(sectionContainer.height() - object.height() - 52, scrollTop - originalY + topMargin);
                if (scrollTop + sidebarHeight + topMargin >= maxHeight) {
                    object.stop(true, true).animate({ top: stopPoint - originalY }, 50);
                } else {
                    object.stop(true, true).animate({ top: newTop }, 50);
                }
            }
        } else {
            object.stop(false, false).css({
                top: 0
            });
        }
    });
}

$(document).ready(function () {
    // Inisialisasi sidebar sticky
    const sidebar = $(".sidebar");
    const sectionContainer = $(".col-md-9");
    const topMargin = 90;
    const maxHeight = window.height; // Set your maximum height here
    elementFollowScroll(sidebar, sectionContainer, topMargin, false, maxHeight);
});
