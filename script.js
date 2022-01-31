var checkExist = setInterval(function() {
    if ($('#readmore').length) {
        $("#readmore").click(function() {
            console.log("button clicked")
            $(".content").slideToggle("fast");
            $(this).toggleClass("open");
        
            if ($(this).hasClass("open")) {
                $(this).html("Read less...");
            } else {
                $(this).html("Read more...");
            }
        })
       clearInterval(checkExist);
    }
}, 100); // Had to use an interval because for some reason jQuery declines to wait until an element exists before adding an onclick function, so this bodge to fix that.

function errorHandler() {
  setTimeout(function() {
    window.location = '/';
  }, 5000);
}

function changeTitle(message) {
  document.title = "Error - Petitie";
  var existFunc = setInterval(function() {
    if (!(document.getElementById("extra-info") === null)) {
      document.getElementById("message").innerText = "Er is iets foutgegaan... Probeer het alstublieft opnieuw!"
      const extraInfo = document.getElementById("extra-info");
      extraInfo.style.display = "block";
      extraInfo.innerHTML = `U wordt in 5 seconden teruggestuurd.`;
      if (message.startsWith("Duplicate entry")) {
        extraInfo.innerHTML += "<br/>U hebt de petitie al ondertekend!"
      }
      console.log(message);

      clearInterval(existFunc);
      errorHandler();
    }
  }, 100);
}

function acceptCookies() {
  document.body.style.opacity = 1;
  document.body.style.backgroundColor = "transparent";
  window.localStorage.setItem("cookieconsent", true);
  document.getElementById("cookieModal").remove();
}

window.addEventListener("load", function() {
  if (document.cookie.length || window.localStorage.length) {
    document.getElementById("cookieModal").remove();
  }
})

function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}