(function () {
    var initialWindowWidth = window.innerWidth;
    var mobileWidth = 768;

    function initiateIFrame(isMobile) {
        var ePardotFormIFrame = document.getElementById("pardot-form");

        if (ePardotFormIFrame !== null) {
            var iFrameURL = new URL(ePardotFormIFrame.getAttribute("src"));

            if (isMobile === true) {
                ePardotFormIFrame.setAttribute("src", iFrameURL.origin + iFrameURL.pathname + "?isMobile=1");
            } else {
                ePardotFormIFrame.setAttribute("src", iFrameURL.origin + iFrameURL.pathname);
            }
        }
    }

    function main() {
        initiateIFrame(window.innerWidth <= mobileWidth);

        window.addEventListener("resize", function () {
            // if window width was above mobile width but shrunk to mobile threshold or below, reinitiate iFrame with mobile version
            if (initialWindowWidth > mobileWidth && window.innerWidth <= mobileWidth) {
                initiateIFrame(true);
            }
            // if window width was at mobile threshold or below but grew out of it, reinitiate iFrame with desktop version
            else if (initialWindowWidth <= mobileWidth && window.innerWidth > mobileWidth) {
                initiateIFrame(false);
            }
        });
    }

    document.addEventListener("DOMContentLoaded", main);
})();
