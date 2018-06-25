//var counter = 0;
$(document).ready(function () {
   // var t0 = performance.now();
    //var t1 = performance.now();
    i = 0;
    while (i < 100) {
        $.ajax({type: "GET",
            url: "http://localhost:8080/Quiz_php5_doctrine/web/app_dev.php",
            async: true,
            success: function (text)
            {
              //  console.log("dupex");
             //   counter++;
            }
        });
        //t1 = performance.now();
        i++;
    }
   // console.log(t1 - t0);
   // console.log("counter: " + counter);
});