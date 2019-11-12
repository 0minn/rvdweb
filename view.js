const trueButton = document.getElementById("voteTrue");
const falseButton = document.getElementById("voteFalse");
const voteSelect = document.getElementById("voteSelect");
const trueBar = document.querySelector("#voteTrue div");
const falseBar = document.querySelector("#voteFalse div");

const coment = document.getElementById("coment");
const comentButton = document.getElementById("comentButton");

const title = document.getElementById('commentTitle');

trueButton.addEventListener("click",()=>{
    falseBar.style.backgroundColor = "rgb(221, 221, 221)";
    trueBar.style.backgroundColor = "#5CBAD7";
    coment.style.border = "2px #5CBAD7 solid";
    comentButton.style.backgroundColor = "#5CBAD7";
	title.style.color = "#2959AC";
	voteSelect.value = "true";
});

falseButton.addEventListener("click",()=>{
    falseBar.style.backgroundColor = "red";
    trueBar.style.backgroundColor = "rgb(221, 221, 221)";
    coment.style.border = "2px red solid";
    comentButton.style.backgroundColor = "red";
	title.style.color = "red";
	voteSelect.value = "false";
});