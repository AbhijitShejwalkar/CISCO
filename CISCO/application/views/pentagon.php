<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
$(function(){
   var canvas=document.getElementById("canvas");
   var cxt=canvas.getContext("2d");
    // hexagon
    var numberOfSides = 5,
        size = 100,
        Xcenter = 150,
        Ycenter = 150,
        step  = 2 * Math.PI / numberOfSides,//Precalculate step value
        shift = (Math.PI / 180.0) * -18;//Quick fix ;)

    cxt.beginPath();
    //cxt.moveTo (Xcenter +  size * Math.cos(0), Ycenter +  size *  Math.sin(0));          

    for (var i = 0; i <= numberOfSides;i++) {
    	var curStep = i * step + shift;
        cxt.lineTo (Xcenter + size * Math.cos(curStep), Ycenter + size * Math.sin(curStep));
    }

    cxt.strokeStyle = "#000000";
    cxt.lineWidth = 1;
    cxt.stroke();
    

  });
</script>

<canvas id="canvas" width=650 height=500></canvas>

