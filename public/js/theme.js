function bg()
{
    let img = document.getElementById("main-logo-img");
    let src1 = "/materials/images/workfitdxr_logo_1.png"
    let src2 = "/materials/images/workfitdxr_logo_2.png"
    let groupCheck = Array.from(document.getElementsByName('xxx'))
    let sepCheck = document.getElementById('xxx2');

    groupCheck[0].onchange = () => {
        if (groupCheck[0].checked) {
            sepCheck.checked = true;
        } else {
            sepCheck.checked = false;
        }
    }

    sepCheck.onchange = () => {
        if (sepCheck.checked) {
                groupCheck[0].checked = true;
        } else {
                groupCheck[0].checked = false;
        }
    }

    if (groupCheck[0].checked == true && sepCheck.checked == false)
    {
        localStorage.removeItem("home-container")
        localStorage.removeItem("navbar-main-dashboard")
        localStorage.removeItem("nav-dashboard-title-text")
        localStorage.removeItem("nav-name-text-hi")
        localStorage.removeItem("nav-name-text")
        localStorage.removeItem("nav-d-text-theme-w-color")
        localStorage.removeItem("nav-d-text-theme-w-weight")
        localStorage.removeItem("nav-d-text-theme-d-color")
        localStorage.removeItem("nav-d-text-theme-d-weight")
        localStorage.removeItem("home-h-title")
        localStorage.removeItem("path-satisfaction")
        localStorage.removeItem("box2-title")
        localStorage.removeItem("box3-title")
        localStorage.removeItem("sidebar-button-on-text")
        localStorage.removeItem("checked")
        localStorage.removeItem("img")

        $(".home-container").css("background-color", "black");
        localStorage.setItem("home-container", document.querySelector(".home-container").style.backgroundColor);
        $(".navbar-main-dashboard").css("background-color", "#292929");
        localStorage.setItem("navbar-main-dashboard", document.querySelector(".navbar-main-dashboard").style.backgroundColor);
        $(".nav-dashboard-title-text").css("color", "#FFFFFF");
        localStorage.setItem("nav-dashboard-title-text", document.querySelector(".nav-dashboard-title-text").style.color);
        $(".nav-name-text-hi").css("color", "#FFFFFF");
        localStorage.setItem("nav-name-text-hi", document.querySelector(".nav-name-text-hi").style.color);
        $(".nav-name-text").css("color", "#FFFFFF");
        localStorage.setItem("nav-name-text", document.querySelector(".nav-name-text").style.color);
        $(".nav-d-text-theme-w").css(
            {
                "color": "#FFFFFF",
                "font-weight": "normal"
            });
        localStorage.setItem("nav-d-text-theme-w-color", document.querySelector(".nav-d-text-theme-w").style.color);
        localStorage.setItem("nav-d-text-theme-w-weight", document.querySelector(".nav-d-text-theme-w").style.fontWeight);
        $(".nav-d-text-theme-d").css(
            {
                "color": "#FFFFFF",
                "font-weight": "bold"
            });
        localStorage.setItem("nav-d-text-theme-d-color", document.querySelector(".nav-d-text-theme-d").style.color);
        localStorage.setItem("nav-d-text-theme-d-weight", document.querySelector(".nav-d-text-theme-d").style.fontWeight);
        $(".home-h-title").css("color", "#FFFFFF");
        localStorage.setItem("home-h-title", document.querySelector(".home-h-title").style.color);
        $(".path-satisfaction").css("fill", "#FFFFFF");
        localStorage.setItem("path-satisfaction", document.querySelector(".path-satisfaction").style.fill);
        $(".box2-title").css("color", "#FFFFFF");
        localStorage.setItem("box2-title", document.querySelector(".box2-title").style.color);
        $(".box3-title").css("color", "#FFFFFF");
        localStorage.setItem("box3-title", document.querySelector(".box3-title").style.color);
        $(".sidebar-button-on-text").css("color", "#FFFFFF");
        localStorage.setItem("sidebar-button-on-text", document.querySelector(".sidebar-button-on-text").style.color);
        localStorage.setItem("checked", true);
        img.src = src2;
        localStorage.setItem("img", "../../materials/images/workfitdxr_logo_2.png");
    }

    else
    {
        localStorage.removeItem("home-container")
        localStorage.removeItem("navbar-main-dashboard")
        localStorage.removeItem("nav-dashboard-title-text")
        localStorage.removeItem("nav-name-text-hi")
        localStorage.removeItem("nav-name-text")
        localStorage.removeItem("nav-d-text-theme-w-color")
        localStorage.removeItem("nav-d-text-theme-w-weight")
        localStorage.removeItem("nav-d-text-theme-d-color")
        localStorage.removeItem("nav-d-text-theme-d-weight")
        localStorage.removeItem("home-h-title")
        localStorage.removeItem("path-satisfaction")
        localStorage.removeItem("box2-title")
        localStorage.removeItem("box3-title")
        localStorage.removeItem("sidebar-button-on-text")
        localStorage.removeItem("checked")
        localStorage.removeItem("img")

        $(".home-container").css("background-color", "#f1efef");
        localStorage.setItem("home-container", document.querySelector(".home-container").style.backgroundColor);
        $(".navbar-main-dashboard").css("background-color", "#FFFFFF");
        localStorage.setItem("navbar-main-dashboard", document.querySelector(".navbar-main-dashboard").style.backgroundColor);
        $(".nav-dashboard-title-text").css("color", "black");
        localStorage.setItem("nav-dashboard-title-text", document.querySelector(".nav-dashboard-title-text").style.color);
        $(".nav-name-text-hi").css("color", "black");
        localStorage.setItem("nav-name-text-hi", document.querySelector(".nav-name-text-hi").style.color);
        $(".nav-name-text").css("color", "black");
        localStorage.setItem("nav-name-text", document.querySelector(".nav-name-text").style.color);
        $(".nav-d-text-theme-w").css(
            {
                "color": "black",
                "font-weight": "bold"
            });
        localStorage.setItem("nav-d-text-theme-w-color", document.querySelector(".nav-d-text-theme-w").style.color);
        localStorage.setItem("nav-d-text-theme-w-weight", document.querySelector(".nav-d-text-theme-w").style.fontWeight);
        $(".nav-d-text-theme-d").css(
            {
                "color": "black",
                "font-weight": "normal"
            });
        localStorage.setItem("nav-d-text-theme-d-color", document.querySelector(".nav-d-text-theme-d").style.color);
        localStorage.setItem("nav-d-text-theme-d-weight", document.querySelector(".nav-d-text-theme-d").style.fontWeight);
        $(".home-h-title").css("color", "black");
        localStorage.setItem("home-h-title", document.querySelector(".home-h-title").style.color);
        $(".path-satisfaction").css("fill", "black");
        localStorage.setItem("path-satisfaction", document.querySelector(".path-satisfaction").style.fill);
        $(".box2-title").css("color", "black");
        localStorage.setItem("box2-title", document.querySelector(".box2-title").style.color);
        $(".box3-title").css("color", "black");
        localStorage.setItem("box3-title", document.querySelector(".box3-title").style.color);
        $(".sidebar-button-on-text").css("color", "black");
        localStorage.setItem("sidebar-button-on-text", document.querySelector(".sidebar-button-on-text").style.color);
        $("#xxx").attr("checked", false);
        $("#xxx2").attr("checked", false);
        img.src = src1;
        localStorage.setItem("img", "/materials/images/workfitdxr_logo_1.png")
    }
}
