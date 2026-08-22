
/* =========================================================
   ULTIMATE MARKETPLACE
   ADMIN CONTROL CENTER
   ADMIN JAVASCRIPT
========================================================= */

document.addEventListener("DOMContentLoaded", function(){

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const sidebar = document.getElementById("adminSidebar");

    const sidebarOverlay =
        document.getElementById("sidebarOverlay");

    const mobileMenuButton =
        document.getElementById("mobileMenuButton");

    const sidebarClose =
        document.getElementById("sidebarClose");

    const profileButton =
        document.getElementById("profileButton");

    const profileDropdown =
        document.getElementById("profileDropdown");

    const adminSearch =
        document.getElementById("adminSearch");


    /* =====================================================
       MOBILE SIDEBAR
    ===================================================== */

    function openSidebar(){

        if(!sidebar){
            return;
        }

        sidebar.classList.add("mobile-open");

        if(sidebarOverlay){

            sidebarOverlay.classList.add("active");

        }

        document.body.style.overflow = "hidden";

    }


    function closeSidebar(){

        if(!sidebar){
            return;
        }

        sidebar.classList.remove("mobile-open");

        if(sidebarOverlay){

            sidebarOverlay.classList.remove("active");

        }

        document.body.style.overflow = "";

    }


    /* =====================================================
       HAMBURGER BUTTON
    ===================================================== */

    if(mobileMenuButton){

        mobileMenuButton.addEventListener(
            "click",
            function(event){

                event.preventDefault();

                event.stopPropagation();

                openSidebar();

            }
        );

    }


    /* =====================================================
       CLOSE BUTTON
    ===================================================== */

    if(sidebarClose){

        sidebarClose.addEventListener(
            "click",
            function(event){

                event.preventDefault();

                closeSidebar();

            }
        );

    }


    /* =====================================================
       OVERLAY
    ===================================================== */

    if(sidebarOverlay){

        sidebarOverlay.addEventListener(
            "click",
            function(){

                closeSidebar();

            }
        );

    }


    /* =====================================================
       CLOSE SIDEBAR AFTER CLICKING NAVIGATION
    ===================================================== */

    if(sidebar){

        const navigationLinks =
            sidebar.querySelectorAll(
                ".navigation-item"
            );


        navigationLinks.forEach(function(link){

            link.addEventListener(
                "click",
                function(){

                    if(window.innerWidth <= 800){

                        closeSidebar();

                    }

                }
            );

        });

    }


    /* =====================================================
       ESCAPE KEY
    ===================================================== */

    document.addEventListener(
        "keydown",
        function(event){

            if(event.key === "Escape"){

                closeSidebar();

                closeProfileDropdown();

            }

        }
    );


    /* =====================================================
       PROFILE DROPDOWN
    ===================================================== */

    function openProfileDropdown(){

        if(!profileButton || !profileDropdown){
            return;
        }

        profileDropdown.classList.add("open");

        profileButton.classList.add("open");

    }


    function closeProfileDropdown(){

        if(!profileButton || !profileDropdown){
            return;
        }

        profileDropdown.classList.remove("open");

        profileButton.classList.remove("open");

    }


    function toggleProfileDropdown(){

        if(!profileDropdown){
            return;
        }

        if(
            profileDropdown.classList.contains("open")
        ){

            closeProfileDropdown();

        }else{

            openProfileDropdown();

        }

    }


    if(profileButton){

        profileButton.addEventListener(
            "click",
            function(event){

                event.preventDefault();

                event.stopPropagation();

                toggleProfileDropdown();

            }
        );

    }


    /* =====================================================
       CLOSE PROFILE WHEN CLICKING OUTSIDE
    ===================================================== */

    document.addEventListener(
        "click",
        function(event){

            if(
                profileDropdown &&
                profileButton &&
                !profileDropdown.contains(event.target) &&
                !profileButton.contains(event.target)
            ){

                closeProfileDropdown();

            }

        }
    );


    /* =====================================================
       ADMIN SEARCH
    ===================================================== */

    if(adminSearch){

        adminSearch.addEventListener(
            "keydown",
            function(event){

                if(event.key === "Enter"){

                    const searchValue =
                        adminSearch.value.trim();


                    if(searchValue !== ""){

                        console.log(
                            "Admin search:",
                            searchValue
                        );

                    }

                }

            }
        );

    }


    /* =====================================================
       "/" SEARCH SHORTCUT
    ===================================================== */

    document.addEventListener(
        "keydown",
        function(event){

            if(
                event.key === "/" &&
                document.activeElement !== adminSearch &&
                event.target.tagName !== "INPUT" &&
                event.target.tagName !== "TEXTAREA"
            ){

                event.preventDefault();


                if(adminSearch){

                    adminSearch.focus();

                }

            }

        }
    );


    /* =====================================================
       RESIZE
    ===================================================== */

    window.addEventListener(
        "resize",
        function(){

            if(window.innerWidth > 800){

                closeSidebar();

            }

        }
    );


});

