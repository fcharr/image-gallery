function getXMLObject()
{
         var xmlHttp = null;
         try
         {
           xmlHttp = new XMLHttpRequest();
         }
         catch(e)
         {
              try
              {
                  xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
              }
              catch(e)
              {
                   try
                   {
                       xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                   }
                   catch(e)
                   {
                         xmlHttp = null;
                   }
              }
         }

         return(xmlHttp);
}

var XMLObject;

var image;
var upload;
var extension;

var reader = new FileReader();
reader.onloadend = function() {
	image.src = reader.result;
}

function preview() {
	reader.readAsDataURL(upload.files[0]);
}

function getExtension(fileName) {
	var partArray = fileName.split(".");
	return(partArray[partArray.length - 1]);
}

function uploadImage() {
	var prefix = document.getElementById("prefix").value;
	var topic = document.getElementById("topic").value;
	var title = document.getElementById("title").value;
	
	if(upload.files.length != 0) {
		extension = getExtension(upload.files[0].name);
	}
	
	if(extension == null) {
		extension = getExtension(image.src);
	}
	
	XMLObject.open("POST", "upload.php", true);
	
	var data = new FormData();
	data.append("prefix", prefix);
	data.append("topic", topic);
	data.append("title", title);
	data.append("extension", extension);
	data.append("reader", reader.result);
	
	XMLObject.send(data);
}

function buildThumbnailPage(page, all) {
	XMLObject.open("POST", "build.php", true);
	
	var data = new FormData();
	data.append("page", page);
	
	if(all == true) {
		data.append("all", true);
	}
	
	XMLObject.send(data);
}

function buildImagePage(prefix, all) {
	XMLObject.open("POST", "build.php", true);
	
	var data = new FormData();
	data.append("prefix", prefix);
	
	if(all == true) {
		data.append("all", true);
	}
	
	XMLObject.send(data);
}

function log() {
	XMLObject.open("POST", "log.php", true);
	
	var data = new FormData();
	data.append("user", document.getElementById("user").value);
	data.append("password", document.getElementById("password").value);
	
	XMLObject.send(data);
}

function add() {
	document.location = "new-image.php";
}

function init() {
	XMLObject = getXMLObject();
	
	image = document.getElementById("image");
	upload = document.getElementById("upload");
	
	XMLObject.onreadystatechange = function(data) {
		if(this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			eval(this.responseText);
		}
	}
}