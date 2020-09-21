
// document.getElementById("inscription").addEventListener("submit",function(e){
// 	e.preventDefault();
// 	var xhr=new XMLHttpRequest();
// 	xhr.onreadystatechange=function(){

// 	};
// 	return false;
// });
document.getElementById("mdp2").addEventListener("input",function(){
	if(this.value != document.getElementById("mdp1").value){
		document.getElementById("mdpjs").innerHTML="Les deux password ne correspondent pas"
	}
	else{
		document.getElementById("mdpjs").innerHTML="";
	}
});
document.getElementById("mdp1").addEventListener("input",function(){
	if(this.value.length < 6 || this.value.length > 10){
		document.getElementById("pwdjs").innerHTML="Le mot de passe doit etre composé de 6 caractéres au plus 10"
	}
	else{
		document.getElementById("pwdjs").innerHTML="";
	}
});
