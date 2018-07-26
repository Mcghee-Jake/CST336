var imgPlayer;
var imgComputer;
var btnRock;
var btnPaper;
var btnScissors;
var btnGo;
var lblRock;
var lblPaper;
var lblScissors;
var playerChoice;
var textEndTitle;
var textEndMessage;

// LISTENERS

$("#btnRock").click(function() {
	select('rock');
});

$("#btnPaper").click(function() {
	select('paper');
});

$("#btnScissors").click(function() {
	select('scissors');
});

$("#btnGo").click(function() {
	go();
});

$("#btnStart").click(function() {
	startGame();
});

$("#btnReplay").click(function() {
	replay();	
});

// FUNCTIONS

function init(){
	imgPlayer = $("#imgPlayer")[0];
	imgComputer = $("#imgComputer")[0];
	btnRock = $("#btnRock")[0];
	btnPaper = $("#btnPaper")[0];
	btnScissors = $("#btnScissors")[0];
	btnGo = $("#btnGo")[0];
	lblRock = $("#lblRock")[0];
	lblPaper = $("#lblPaper")[0];
	lblScissors = $("#lblScissors")[0];
	textEndTitle = $("#textEndTitle");
	textEndMessage = $("#textEndMessage");
	deselectAll();
}

function deselectAll() {
	btnRock.style.backgroundColor = 'silver';
	btnPaper.style.backgroundColor = 'silver';
	btnScissors.style.backgroundColor = 'silver';
	lblRock.style.backgroundColor = '#EEEEEE';
	lblPaper.style.backgroundColor = '#EEEEEE';
	lblScissors.style.backgroundColor = '#EEEEEE';
}

function select(choice){
	playerChoice = choice;
	imgPlayer.src = 'images/' + choice + '.png';
	deselectAll();
	btnGo.style.display = 'block';
	switch (choice) {
		case ('rock'):
			btnRock.style.backgroundColor = '#888888';
			break;
		case ('paper'):
			btnPaper.style.backgroundColor = '#888888';
			break;
		case ('scissors'):
			btnScissors.style.backgroundColor = '#888888'
			break;
	}
}

function go() {
	var numChoice = Math.floor(Math.random()*3);
	
	switch (numChoice) {
		case (0):
			imgComputer.src = 'images/rock.png';
			lblRock.style.backgroundColor = 'yellow';
			
			switch (playerChoice) {
				case ('rock'):
					textEndTitle.html('');
					textEndMessage.html('TIE');
					break;
				case ('paper'):
					textEndTitle.html('Paper covers Rock');
					textEndMessage.html('YOU WIN');
					break;
				case ('scissors'):
					textEndTitle.html('Rock smashes Scissors');
					textEndMessage.html('YOU LOSE');
					break;
			}
			break;
		case (1):
			imgComputer.src = 'images/paper.png';
			lblPaper.style.backgroundColor = 'yellow';
			
			switch (playerChoice) {
				case ('rock'):
					textEndTitle.html('Paper covers Rock');
					textEndMessage.html('YOU LOSE');
					break;
				case ('paper'):
					textEndTitle.html('');
					textEndMessage.html('TIE');
					break;
				case ('scissors'):
					textEndTitle.html('Scissors cuts Paper');
					textEndMessage.html('YOU WIN');
					break;
			}
			break;
		case (2):
			imgComputer.src = 'images/scissors.png';
			lblScissors.style.backgroundColor = 'yellow';
			
			switch (playerChoice) {
				case ('rock'):
					textEndTitle.html('Rock smashes Scissors');
					textEndMessage.html = 'YOU WIN';
					break;
				case ('paper'):
					textEndTitle.html('Scissors cuts Paper');
					textEndMessage.html('YOU LOSE');
					break;
				case ('scissors'):
					textEndTitle.html('');
					textEndMessage.html('TIE');
					break;
			}
			break;
	}
	
	$("#endScreen")[0].style.display = 'block';
	
}

function startGame(){
	$("#introScreen")[0].style.display = 'none';
}

function replay(){
	deselectAll();
	imgPlayer.src = 'images/question.png';
	imgComputer.src = 'images/question.png';
	btnGo.style.display = 'none';
	$("#endScreen")[0].style.display = 'none';
}