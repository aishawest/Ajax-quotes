<html>
  <head>
    <title>AJAX quotes</title>
    <style>

      @import url('https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Tulpen+One&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');

      
      /* CSS to hide the quote container initially and apply fade-in animation */
        #quoteContainer {
            display: none;
            text-shadow: 4px 4px 4px #aaa;
        }

        /* CSS for the fade-in animation */
        .fade-in {
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

    </style>
  </head>
  <body>
    <h1>AJAX quotes</h1>
    <p>Random quote is generated every 5 seconds</p>
    <!-- <button onclick="getRandomQuote()">Get Random Quote</button> -->
    <div id="quoteContainer">Quote goes here</div>
    <script>

      var counter = 0;
      
      function getRandomQuote(){

        var fonts = ["Qwitcher Grypen", "Tulpen One", "Shadows Into Light"];
        
        var xhr = new XMLHttpRequest();

        xhr.open('GET', 'random_quotes.php', true);
        
        xhr.onload = function(){
          // code on return of data goes here
          if(xhr.status >= 200 && xhr.status < 300){//good data return, show it
            // document.querySelector("#quoteContainer").innerText = xhr.responseText;

            var quoteContainer = document.querySelector("#quoteContainer");
            quoteContainer.innerText = xhr.responseText;
            quoteContainer.style.display = "block";

            quoteContainer.style.fontFamily = fonts[counter];
            counter ++;
            if(counter >= fonts.length){
              counter = 0;
            }
            
            quoteContainer.classList.add("fade-in");

            setTimeout(function(){
              quoteContainer.classList.remove("fade-in");
            },1000);

              
          }else{// something went wrong, feedback
            document.querySelector("#quoteContainer").innerText = "failed to fetch quote: " + xhr.status;
          }
        };
        
        //
        xhr.onerror = function(){
          // code on error goes here
          alert("oh oh!")
        };

        // send data to server
        xhr.send()
        
      }

      function displayRandomQuote(){
        //inital page load
        getRandomQuote()
        //run again at intervals
        setInterval(getRandomQuote, 5000)
      }

      //run on page load
      displayRandomQuote()
      
    </script>
  
  </body>
</html>
