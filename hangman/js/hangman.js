// VARIABLES
var selectedWord = "";
var selectedHint = "";
var guessedWords = "";
var board = [];
var remainingGuesses = 6;
var words = [{ word: "snake", hint: "It's a reptile"},
             { word: "monkey", hint: "It's a mammal"},
             { word: "beetle", hint: "It's an insect" }];
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
                'Q', 'R', 'S', 'T', 'U', 'V','W', 'X',
                'Y', 'Z'];

// LISTENERS
window.onload = startGame();

$(".letter").click(function() {
    checkLetters($(this).attr("id"));
    disableButton($(this));
});

$(".replayBtn").on("click", function() {
    window.sessionStorage.setItem("guessedWords", document.getElementById("guessed-words").innerHTML);
    location.reload();
});

$("#hint").click(function() {
    getHint();
});


// FUNCTIONS
function startGame() {
    pickWord();
    initBoard();
    initHint();
    createLetters();
    updateBoard();
    loadGuesses();
}

function initBoard() {
    for (var letter in selectedWord) {
        board.push("_");
    }
}

function pickWord() {
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}


function updateBoard() {
    $("#word").empty();
    
    for (var letter of board) {
        document.getElementById("word").innerHTML += letter + " ";
    }
}

function createLetters() {
    for (var letter of alphabet) {
        $("#letters").append("<button class='letter btn btn-success' id='" + letter + "'>" + letter + "</button>");
    }
}

function checkLetters(letter) {
    var positions = new Array();
    
    for (var i=0; i < selectedWord.length; i++) {
        if (letter == selectedWord[i]) {
            positions.push(i);
        }
    }
    
    if (positions.length > 0) {
        updateWord(positions, letter);
        
        if (!board.includes('_')) {
            endGame(true);
        }
        
    } else {
        remainingGuesses -= 1;
        updateMan();
    }
    
    if (remainingGuesses <= 0) {
        endGame(false)
    }
}

function updateWord(positions, letter) {
    for (var pos of positions) {
        board[pos] = letter;
    }
    updateBoard();
}

function updateMan() {
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}

function endGame(win) {
    $("#letters").hide();
    
    if (win) {
        $('#won').show();
        displayGuessedWord();
    } else {
        $('#lost').show();
    }
}

function disableButton(btn) {
    btn.prop("disabled", true);
    btn.attr("class", "btn btn-danger");
}

function initHint() {
    $("#hint").append("<button class='btn btn-warning'> Hint </button>");
}

function getHint() {
    remainingGuesses -= 1;
    updateMan();
    $("#hint").empty();
    $("#hint").append("<span class='hint'>Hint: " + selectedHint + "</span>");
}

function displayGuessedWord() {
     $("#guessed-words").append("<br>" + selectedWord);
     $('#guessed-words').show();
}

function loadGuesses(){
    guessedWords = window.sessionStorage.getItem('guessedWords');
    if (guessedWords !== null) {
        document.getElementById("guessed-words").innerHTML = guessedWords;
        $('#guessed-words').show();
    }
}







