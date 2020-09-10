<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="container">
            <!-- Right Side Of Navbar -->
        <div class="w3-container w3-display-container w3-padding-16">
            <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
            <a href="{{ url('/') }}">
                <img style="width: 10rem;" src="/img/logo/logo.jpeg">
            </a>
        </div>
        <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
            <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
                Camisetas
            <i class="fa fa-caret-down"></i>
        </a>
        <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <a href="{{route('produto.index')}}" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-caret-right w3-margin-right"></i>T-Shirt</a>
            <a href="#" class="w3-bar-item w3-button">Disabled</a>
        </div>
        </div>
    </div>
    <a href="#footer" class="w3-bar-item w3-button w3-padding">Contato</a> 
    <a href="#footer"  class="w3-bar-item w3-button w3-padding">Cadastre-se</a>

    <script>
        function inscricao()
        {
            document.getElementById('newsletter').style.display='block';
        }
        // Open and close sidebar
        function w3_open() {
          document.getElementById("mySidebar").style.display = "block";
          document.getElementById("myOverlay").style.display = "block";
        }
         
        function w3_close() {
          document.getElementById("mySidebar").style.display = "none";
          document.getElementById("myOverlay").style.display = "none";
        }
        // Accordion 
        function myAccFunc() {
          var x = document.getElementById("demoAcc");
          if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
          } else {
            x.className = x.className.replace(" w3-show", "");
          }
        }
    </script>
</nav>