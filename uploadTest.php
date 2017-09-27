<?php

//include 'header.php'
?>
<html lang="en-GB">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
<hr />
<div id="dvCSV">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>     
<script lang="javascript" src="sheetJS/dist/xlsx.full.min.js"></script>
<script lang="javascript" src="require.js"></script>


<style>
  .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
</style>
<input type="button" id="upload" value="Upload" />

<input type="file" id="files" name="files[]" multiple />
<output id="list"></output>
<div id="drop">Drop a spreadsheet file here to see sheet data</div>
<style>
#drop{
	border:2px dashed #bbb;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	padding:25px;
	text-align:center;
	font:20pt bold,"Vollkorn";color:#bbb
}
#b64data{
	width:100%;
}
a { text-decoration: none }
</style>
<script>
 /* processing array buffers, only required for readAsArrayBuffer */
function fixdata(data) {
  var o = "", l = 0, w = 10240;
  for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
  o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
  return o;
}

var rABS = true; // true: readAsBinaryString ; false: readAsArrayBuffer
/* set up drag-and-drop event */
function handleDrop(e) {
    console.log("DROPPING");
  e.stopPropagation();
  e.preventDefault();
  var files = e.dataTransfer.files;
  var i,f;
  for (i = 0; i != files.length; ++i) {
    f = files[i];
    var reader = new FileReader();
    var name = f.name;
    reader.onload = function(e) {
      var data = e.target.result;

      var workbook;
      if(rABS) {
        /* if binary string, read with type 'binary' */
        workbook = XLSX.read(data, {type: 'binary'});
      } else {
        /* if array buffer, convert to base64 */
        var arr = fixdata(data);
        workbook = XLSX.read(btoa(arr), {type: 'base64'});
      }

      var trans = workbook["Sheets"]["List of transactions"];
      
      
      var dataArray = [];
        for (var key in trans) {
            dataArray.push(trans[key]["v"]);         // Push the key on the array
        }
      console.log(dataArray);

      var arrayOfDates = [];
        for(var i = 0; i<dataArray.length;i++){
            if(dataArray[i]){
                if(typeof dataArray[i] === "string"){
                    if(dataArray[i].indexOf("/") >=0){
                        console.log(dataArray[i] + " " + dataArray[i+1] + " " + dataArray[i+2] + " " + dataArray[i+3] + " " + dataArray[i+4] + " " + dataArray[i+5] + " " + dataArray[i+6] + " " + dataArray[i+7] + " " + dataArray[i+8] + " " +dataArray[i+9] + " " );
                        arrayOfDates.push(dataArray[i]);
                    }
                }
            }
        }
    
    console.log(arrayOfDates);
      
      

      /* DO SOMETHING WITH workbook HERE */
    };
    if(rABS) reader.readAsBinaryString(f);
    else reader.readAsArrayBuffer(f);
  }
}
var dropbox;

dropbox = document.getElementById("drop");
dropbox.addEventListener("dragenter", handleDrop, false);
dropbox.addEventListener("dragover", handleDrop, false);
dropbox.addEventListener("drop", handleDrop, false);
</script>

