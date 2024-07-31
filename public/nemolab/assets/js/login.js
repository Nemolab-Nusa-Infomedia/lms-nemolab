// input password
var a;
function pass() {
  if (a == 1) {
    document.getElementById("password").type = "password";
    document.getElementById("pass-icon").src = "../image/eye.png";
    a = 0;
  } else {
    document.getElementById("password").type = "text";
    document.getElementById("pass-icon").src = "../image/hidden.png";
    a = 1;
  }
}
// input file
function updateFileName() {
  const input = document.getElementById("fileInput");
  const label = input.nextElementSibling;
  const fileName = input.files[0] ? input.files[0].name : "Choose avatar";
  label.setAttribute("data-placeholder", fileName);
}