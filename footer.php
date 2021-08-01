</section>

<script>
//accout login toggle
function authVerify() {


   var element = document.getElementById("login-body");
   element.classList.toggle("active-login");


}
//sidebar
function sidebarToggle() {



   var element = document.getElementById("sidebar");
  var content = document.getElementById("content");
   element.classList.toggle("active-sidebar");
   content.classList.toggle("active-content");

}
</script>
</body>
</html>